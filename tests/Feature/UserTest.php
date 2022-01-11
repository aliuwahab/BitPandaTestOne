<?php

namespace Tests\Feature;

use App\Models\Country;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_all_users_if_no_filter_is_provided()
    {
        $users = User::factory()->count(5)->create();
        $userOne = $users->first();

        $response = $this->getJson(route('api.users'));

        $response->assertStatus(200)
            ->assertJsonCount($users->count(), 'data')
            ->assertJsonFragment(['email' => $userOne->email]);
    }

    public function test_an_invalid_filter_key_will_return_error_response()
    {
        User::factory()->count(5)->create();

        $response = $this->getJson(route('api.users', ['invalidFilterKey' => 1]));

        $response->assertStatus(400);
    }

    public function test_can_filter_users_by_status()
    {
        $matchingUser = User::factory(['active' => true])->create();
        UserDetail::factory(['user_id' => $matchingUser->id]);

        $nonMatchingUser = User::factory(['active' => false])->create();
        UserDetail::factory(['user_id' => $nonMatchingUser->id]);


        $response = $this->getJson(route('api.users', ['status' => 1]));

        $response->assertStatus(200)
            ->assertJsonCount(1, 'data')
            ->assertJsonFragment(['email' => $matchingUser->email])
            ->assertJsonMissing(['email' => $nonMatchingUser->email]);
    }

    public function test_can_filter_users_by_nationality_iso_code_or_country_name()
    {
        $matchingCountry = Country::factory(['name' => 'Austria', 'iso2' => 'AT', 'iso3' => 'AUT'])->create();
        $matchingUser = User::factory()->create();
        UserDetail::factory(['user_id' => $matchingUser->id, 'citizenship_country_id' => $matchingCountry->id])->create();

        $nonMatchingCountry = Country::factory(['name' => 'Austria', 'iso2' => 'GH', 'iso3' => 'GHA'])->create();
        $nonMatchingUser = User::factory(['active' => false])->create();
        UserDetail::factory(['user_id' => $nonMatchingUser->id, 'citizenship_country_id' => $nonMatchingCountry->id])->create();

        $response = $this->getJson(route('api.users', ['nationality' => $matchingCountry->iso2]));

        $response->assertStatus(200)
            ->assertJsonCount(1, 'data')
            ->assertJsonFragment(['email' => $matchingUser->email])
            ->assertJsonMissing(['email' => $nonMatchingUser->email]);
    }


    public function test_cannot_update_a_user_details_when_the_user_has_no_existing_user_details()
    {
        $user = User::factory()->create();

        $response = $this->patch(route('api.users.update', $user));

        $response->assertStatus(405);
    }


    public function test_can_update_a_user_details_when_the_user_has_existing_user_details()
    {
        $user = User::factory()->create();
        UserDetail::factory(['user_id' => $user->id])->create();

        $updatedUserDetails = ['first_name' => 'Updated First Name', 'last_name' => 'Updated Last Name', 'phone_number' => '+141414141414'];

        $response = $this->patchJson(route('api.users.update', $user), $updatedUserDetails);

        $response->assertStatus(200);
        $this->assertDatabaseHas('user_details', $updatedUserDetails);

    }


    public function test_cannot_delete_a_user_with_user_details()
    {
        $user = User::factory()->create();
        UserDetail::factory(['user_id' => $user->id])->create();

        $response = $this->delete(route('api.users.delete', $user));

        $response->assertStatus(405);
        $this->assertDatabaseHas('users', ['id' => $user->id, 'email' => $user->email]);
    }


    public function test_can_delete_user_without_details()
    {
        $user = User::factory()->create();

        $response = $this->delete(route('api.users.delete', $user));

        $response->assertStatus(200);
        $this->assertDatabaseMissing('users', ['id' => $user->id, 'email' => $user->email]);
    }
}

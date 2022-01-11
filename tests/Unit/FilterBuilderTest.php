<?php

namespace Tests\Unit;

use App\Models\User;
use BitPanda\Exceptions\NotAValidFilterKeyException;
use BitPanda\Filters\FilterBuilder;
use Illuminate\Database\Eloquent\Builder;
use Tests\TestCase;

class FilterBuilderTest extends TestCase
{

    public function test_can_build_filters_and_returns_instance_of_query_builder()
    {
        $filterNameSpace = 'BitPanda\Filters\UserProfile';
        $userQueryFilterBuilder = User::query()->with('profile.nationality');
        $filters = ['status' => "1"];

        $filters = (new FilterBuilder($userQueryFilterBuilder, $filters, $filterNameSpace))->apply();


        $this->assertInstanceOf(Builder::class, $filters);
    }


    public function test_if_invalid_filter_key_it_throws_exception()
    {
        $this->expectException(NotAValidFilterKeyException::class);
        $filterNameSpace = 'BitPanda\Filters\UserProfile';
        $userQueryFilterBuilder = User::query()->with('profile.nationality');
        $filters = ['inValidFilterKey' => "1"];

        (new FilterBuilder($userQueryFilterBuilder, $filters, $filterNameSpace))->apply();
    }
}

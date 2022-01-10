<?php
namespace BitPanda\UserProfile\Eloquent;

use App\Http\Resources\UserProfileResource;
use App\Models\User;
use BitPanda\Filters\FilterBuilder;
use BitPanda\UserProfile\UserProfileRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;


class UserProfileRepository implements UserProfileRepositoryInterface
{
    public const USER_PROFILE_FILTERS_NAMESPACE = 'BitPanda\Filters\UserProfile';

    public function create(array $userDetails): Model
    {
        // TODO: Implement create() method.
    }


    public function update(User $user, array $userDetails): Model
    {
        $user->profile->fill($userDetails);
        $user->profile->save();

        return $user;
    }


    public function filterBy(array $filters = [], int $paginateBy = 50): Paginator
    {
        $userQueryFilterBuilder = User::query()->with('profile.nationality');

        $filters = new FilterBuilder($userQueryFilterBuilder, $filters, self::USER_PROFILE_FILTERS_NAMESPACE);

        $paginateBy = 1;
        return $filters->apply()->simplePaginate($paginateBy);
    }

    public function delete(User $user): void
    {
        $user->delete();
    }

}

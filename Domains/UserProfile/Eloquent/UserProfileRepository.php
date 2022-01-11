<?php
namespace BitPanda\UserProfile\Eloquent;

use App\Models\User;
use BitPanda\Filters\FilterBuilder;
use BitPanda\UserProfile\UserProfileRepositoryInterface;
use Illuminate\Database\Eloquent\Model;


class UserProfileRepository implements UserProfileRepositoryInterface
{
    public const USER_PROFILE_FILTERS_NAMESPACE = 'BitPanda\Filters\UserProfile';

    public function update(User $user, array $userDetails): Model
    {
        $user->profile->fill($userDetails);
        $user->profile->save();

        return $user;
    }


    public function filterBy(array $filters = [], int $paginateBy = 50): \Illuminate\Contracts\Pagination\Paginator
    {
        $userQueryFilterBuilder = User::query()->with('profile.nationality');

        $filters = new FilterBuilder($userQueryFilterBuilder, $filters, self::USER_PROFILE_FILTERS_NAMESPACE);

        return $filters->apply()->simplePaginate($paginateBy);
    }

    public function delete(User $user): void
    {
        $user->delete();
    }

}

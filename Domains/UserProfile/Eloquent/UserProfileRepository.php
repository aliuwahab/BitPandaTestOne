<?php
namespace BitPanda\UserProfile\Eloquent;

use App\Http\Resources\UserProfileResource;
use App\Models\User;
use BitPanda\Filters\FilterBuilder;
use BitPanda\UserProfile\UserProfileRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class UserProfileRepository implements UserProfileRepositoryInterface
{
    public const USER_PROFILE_FILTERS_NAMESPACE = 'BitPanda\Filters\UserProfile';

    public function create(array $userDetails): Model
    {
        // TODO: Implement create() method.
    }


    public function update(int $userId, array $userDetails): Model
    {
        // TODO: Implement create() method.
    }


    public function filterBy(array $filters = [], int $paginateBy = 50)
    {
        $userQueryFilterBuilder = User::query()->with('profile.nationality');

        $filters = new FilterBuilder($userQueryFilterBuilder, $filters, self::USER_PROFILE_FILTERS_NAMESPACE);

        return $filters->apply()->simplePaginate($paginateBy);
    }

    public function delete(int $id): ?Model
    {
        // TODO: Implement delete() method.
    }

}

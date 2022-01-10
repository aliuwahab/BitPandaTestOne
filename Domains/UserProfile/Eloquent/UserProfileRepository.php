<?php
namespace BitPanda\UserProfile\Eloquent;

use App\Models\User;
use BitPanda\Filters\FilterBuilder;
use BitPanda\UserProfile\UserProfileRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;

class UserProfileRepository implements UserProfileRepositoryInterface
{
    public const USER_PROFILE_FILTERS_NAMESPACE = 'BitPanda\Filters\UserProfile';

    public function filterBy(array $filters = [], int $paginateBy = 50): Paginator
    {
        $userQueryFilterBuilder = User::with('profile.nationality')->query();

        $filters = new FilterBuilder($userQueryFilterBuilder, $filters, self::USER_PROFILE_FILTERS_NAMESPACE);

        return $filters->apply()->simplePaginate($paginateBy);
    }

    public function create(string $title, string $body, array $categories): Model
    {
        // TODO: Implement create() method.
    }

    public function find(int $id): ?Model
    {
        // TODO: Implement find() method.
    }

    public function delete(int $id): ?Model
    {
        // TODO: Implement delete() method.
    }
}

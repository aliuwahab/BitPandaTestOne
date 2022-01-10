<?php
namespace BitPanda\UserProfile;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;

interface UserProfileRepositoryInterface
{
    public function create(array $userDetails): Model;

    public function update(int $userId, array $userDetails): Model;

    public function delete(int $id): ?Model;

    public function filterBy(array $filters = [], int $paginateBy = 50);

}

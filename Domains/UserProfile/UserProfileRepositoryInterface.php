<?php
namespace BitPanda\UserProfile;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;

interface UserProfileRepositoryInterface
{
    public function create(string $title, string $body, array $categories): Model;

    public function find(int $id): ?Model;

    public function delete(int $id): ?Model;

    public function filterBy(array $filters = [], int $paginateBy = 50): Paginator;

}

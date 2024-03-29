<?php
namespace BitPanda\UserProfile;

use App\Models\User;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;

interface UserProfileRepositoryInterface
{
    public function filterBy(array $filters = [], int $paginateBy = 50): Paginator;

    public function update(User $user, array $updatedDetails): Model;

    public function delete(User $user): void;
}

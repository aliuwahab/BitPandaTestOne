<?php


namespace BitPanda\Filters\UserProfile;


use BitPanda\Filters\FilterInterface;
use BitPanda\Filters\QueryFilter;

class Status extends QueryFilter implements FilterInterface
{
    public function handle($isActive): void
    {
        $this->query->where('active', (bool) $isActive);
    }

}

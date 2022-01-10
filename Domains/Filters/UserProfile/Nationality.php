<?php


namespace BitPanda\Filters\UserProfile;



use BitPanda\Filters\FilterInterface;
use BitPanda\Filters\QueryFilter;

class Nationality extends QueryFilter implements FilterInterface
{

    public function handle($value): void
    {
        $this->query->where('profile.nationality.iso2', $value)->orWhere('profile.nationality.iso3', $value);
    }
}

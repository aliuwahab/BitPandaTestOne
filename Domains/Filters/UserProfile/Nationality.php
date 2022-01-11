<?php


namespace BitPanda\Filters\UserProfile;

use BitPanda\Filters\FilterInterface;
use BitPanda\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class Nationality extends QueryFilter implements FilterInterface
{
    public function handle($value): void
    {
        $this->query->whereHas('profile.nationality', function (Builder $query) use ($value) {
            $query->where('countries.iso2', Str::upper($value))
                ->orWhere('countries.iso3', Str::upper($value))
                ->orWhere('countries.name', Str::ucfirst($value));
        });
    }
}

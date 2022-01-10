<?php


namespace BitPanda\Filters\UserProfile;



use BitPanda\Filters\FilterInterface;
use BitPanda\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;

class Nationality extends QueryFilter implements FilterInterface
{

    public function handle($value): void
    {
//        $this->query->where('profile.nationality.iso2', $value)->orWhere('profile.nationality.iso3', $value);
        $this->query->whereHas('profile.nationality', function (Builder $query) use($value){
            $query->where('countries.iso2', $value)->orWhere('countries.iso3', $value);
        });
    }
}

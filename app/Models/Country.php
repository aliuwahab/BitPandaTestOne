<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'iso2',
        'iso3',
    ];

    public function citizens(): HasMany
    {
        return $this->hasMany(UserDetail::class)->with('user');
    }

//    /**
//     * Get all of the citizens for the country via the user detail.
//     */
//    public function nationals()
//    {
//        return $this->hasManyThrough(User::class, UserDetail::class, 'citizenship_country_id', 'user_id');
//    }
}

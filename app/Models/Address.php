<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    // hasOne country
    public function country()
    {
        return $this->hasOne(Country::class);
    }


    // hasOne city
    public function city()
    {
        return $this->hasOne(City::class);
    }

    // hasOne district
    public function district()
    {
        return $this->hasOne(District::class);
    }

// hasOne neighborhood
    public function neighborhood()
    {
        return $this->hasOne(Neighborhood::class);
    }

    // hasOne village
    public function village()
    {
        return $this->hasOne(Village::class);
    }


    // hasOne street
    public function street()
    {
        return $this->hasOne(Street::class);
    }



    // belongsTo warehouse
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
}

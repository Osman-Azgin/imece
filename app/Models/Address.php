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
        return $this->belongsTo(Country::class);
    }


    // hasOne city
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    // hasOne district
    public function district()
    {
        return $this->belongsTo(District::class);
    }

// hasOne neighborhood
    public function neighborhood()
    {
        return $this->belongsTo(Neighborhood::class);
    }

    // hasOne village
    public function village()
    {
        return $this->hasOne(Village::class);
    }


    // hasOne street
    public function street()
    {
        return $this->belongsTo(Street::class);
    }



    // belongsTo warehouse
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
}

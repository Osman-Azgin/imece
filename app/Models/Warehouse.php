<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;

    // belongsTo team

    public function team()
    {
        return $this->belongsTo(Team::class);
    }


    //has Many requirements

    public function requirements()
    {
        return $this->hasMany(Requirement::class);
    }

    //has Many imeces

    public function imeces()
    {
        return $this->hasMany(Imece::class);
    }

    // has one address
    public function address()
    {
        return $this->hasOne(Address::class);
    }
}

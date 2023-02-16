<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imece extends Model
{
    use HasFactory;

    // belongsTo warehouse
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    // belongsTo team
    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    // belongsTo requirement

    public function requirement()
    {
        return $this->belongsTo(Requirement::class);
    }


}

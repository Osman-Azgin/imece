<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
    use HasFactory;

    // belongsTo warehouse
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    // belongsTo inkindDonation
    public function inkindDonation()
    {
        return $this->belongsTo(InKindDonation::class,"in_kind_donation_id","id");
    }
}

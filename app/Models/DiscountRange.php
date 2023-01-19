<?php

namespace App\Models;

use App\Models\Discount;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DiscountRange extends Model
{
    use HasFactory;

    protected $table = 'discount_ranges';

    protected $guarded = [];

    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }
}

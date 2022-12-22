<?php

namespace App\Models;

use App\Models\Discount;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
    use HasFactory;

    public function scopeActive($query)
    {
        return $query->where('active', '1');
    }

    public function discount()
    {
        return $this->hasMany(Discount::class);
    }
}

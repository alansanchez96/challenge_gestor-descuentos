<?php

namespace App\Models;

use App\Models\Discount;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Region extends Model
{
    use HasFactory;

    public function discount()
    {
        return $this->hasMany(Discount::class);
    }
}

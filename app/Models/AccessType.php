<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AccessType extends Model
{
    use HasFactory;

    protected $table = 'access_types';

    public function discount()
    {
        return $this->hasMany(Discount::class);
    }
}

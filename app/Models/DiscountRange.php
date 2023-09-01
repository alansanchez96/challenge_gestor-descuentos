<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DiscountRange extends Model
{
    use HasFactory;

    protected $table = 'discount_ranges';

    protected $guarded = [];

    public function getDiscountPercentageFormatedAttribute()
    {
        if (!$this->discount) return '--';

        return "{$this->discount}%";
    }

    public function getPeriodFormatedAttribute()
    {
        return "{$this->from_days} - {$this->to_days}";
    }

    public function getCodeFormatedAttribute()
    {
        if (!$this->code) return '--';

        return Str::upper($this->code);
    }

    public function discount()
    {
        return $this->belongsTo(Discount::class, 'discount_id', 'id');
    }
}

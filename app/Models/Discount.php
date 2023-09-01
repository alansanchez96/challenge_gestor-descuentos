<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Discount extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'discounts';

    protected $primaryKey = 'id';

    protected $dates = ['deleted_at'];

    protected $guarded = [];

    public function getStartDateFormatedAttribute()
    {
        return date('d M Y', strtotime($this->start_date));
    }

    public function getEndDateFormatedAttribute()
    {
        return date('d M Y', strtotime($this->end_date));
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function accessType()
    {
        return $this->belongsTo(AccessType::class, 'access_type_code', 'code');
    }

    public function discountsRanges()
    {
        return $this->hasMany(DiscountRange::class, 'discount_id', 'id');
    }
}

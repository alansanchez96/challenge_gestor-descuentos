<?php

namespace App\Models;

use App\Models\Brand;
use App\Models\Region;
use App\Models\AccessType;
use App\Models\DiscountRange;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Discount extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'discounts';

    protected $primaryKey = 'code';

    protected $dates = ['deleted_at'];

    protected $guarded = [];

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

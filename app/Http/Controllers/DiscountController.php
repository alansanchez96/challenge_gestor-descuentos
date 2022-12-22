<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Region;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\DiscountRequest;
use App\Models\AccessType;
use App\Models\Discount;
use App\Models\DiscountRange;

class DiscountController extends Controller
{
    public function index()
    {
        $discounts = Discount::with([
            'brand' => fn ($query) => $query->whereActive('1')
        ])->whereHas('brand', fn ($query) => $query->whereActive('1'))->paginate(5);

        return view('discount.index', compact('discounts'));
    }

    public function create()
    {
        $brands = Brand::active()->orderBy('display_order', 'desc')->get();
        $accessTypes = AccessType::all()->sortBy('display_order');
        $regions = Region::all()->sortByDesc('display_order');

        return view('discount.create', compact('brands', 'accessTypes', 'regions'));
    }

    public function store(DiscountRequest $request)
    {
        $discount = new Discount();
        $discountRanges = new DiscountRange();

        $discount->name = $request->discounts_name;
        $discount->priority = $request->discounts_priority;
        $discount->start_date = /* $request->start_date; */ '2022-08-02';
        $discount->end_date = /* $request->end_date; */     '2022-08-02';
        $discount->active = $request->discounts_active;
        $discount->region_id = $request->discounts_region_id;
        $discount->brand_id = $request->discount_brand_id;
        $discount->access_type_code = $request->discounts_access_type_code;
        $discount->save();

        $discountRanges->from_days = $request->from_days_1;
        $discountRanges->to_days = $request->to_days_1;
        $discountRanges->code = $request->discount_code_1;
        $discountRanges->discount = $request->discount_percent_1;

        $discountModel = Discount::where('name', $request->discounts_name)->get();
        
        $discountRanges->discount_id = $discountModel[0]->id;
        $discountRanges->save();

        return $discount;
    }
}

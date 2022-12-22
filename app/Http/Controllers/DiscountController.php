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

    public function store(Request $request)
    {
        $discount = new Discount();
        $discount->name = $request->discounts_name;
        $discount->priority = $request->discounts_priority;
        $discount->start_date = $request->start_date;
        $discount->end_date = $request->end_date;
        $discount->active = $request->discounts_active;
        $discount->region_id = $request->discounts_region_id;
        $discount->brand_id = $request->discount_brand_id;
        $discount->access_type_code = $request->discounts_access_type_code;
        $discount->save();

        $discountModel = Discount::where('name', $request->discounts_name)->get();

        $discountRanges = new DiscountRange();
        $discountRanges->from_days = $request->from_days_1;
        $discountRanges->to_days = $request->to_days_1;
        $discountRanges->code = $request->discount_code_1;
        $discountRanges->discount = $request->discount_percent_1;
        $discountRanges->discount_id = $discountModel[0]->id;

        $discountRanges->save();

        if ($request->from_days_2 && $request->to_days_2 !== null) {
            $discountRanges_2 = new DiscountRange();
            $discountRanges_2->from_days = $request->from_days_2;
            $discountRanges_2->to_days = $request->to_days_2;
            $discountRanges_2->code = $request->discount_code_2;
            $discountRanges_2->discount = $request->discount_percent_2;
            $discountRanges_2->discount_id = $discountModel[0]->id;

            $discountRanges_2->save();
        }

        if ($request->from_days_3 && $request->to_days_3 !== null) {
            $discountRanges_3 = new DiscountRange();
            $discountRanges_3->from_days = $request->from_days_3;
            $discountRanges_3->to_days = $request->to_days_3;
            $discountRanges_3->code = $request->discount_code_3;
            $discountRanges_3->discount = $request->discount_percent_3;
            $discountRanges_3->discount_id = $discountModel[0]->id;

            $discountRanges_3->save();
        }



        return $discount;
    }
}

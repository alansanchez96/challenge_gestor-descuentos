<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Region;
use App\Models\Discount;
use App\Models\AccessType;
use App\Http\Controllers\Controller;
use App\Http\Requests\DiscountRequest;
use App\Http\Requests\DiscountRangeRequest;

class DiscountController extends Controller
{
    public function index()
    {
        return view('discount.index');
    }

    public function create()
    {
        $brands = Brand::active()->orderBy('display_order', 'desc')->get();
        $accessTypes = AccessType::all()->sortBy('display_order');
        $regions = Region::all()->sortByDesc('display_order');

        return view('discount.create', compact('brands', 'accessTypes', 'regions'));
    }

    public function store(DiscountRequest $discountRequest, DiscountRangeRequest $discountRangeRequest)
    {
        $discount = Discount::firstOrCreate([
            'name' => $discountRequest->discounts_name,
            'start_date' => $discountRequest->start_date,
            'end_date' => $discountRequest->end_date,
            'priority' => $discountRequest->discounts_priority,
            'active' => $discountRequest->discounts_active,
            'region_id' => $discountRequest->discounts_region_id,
            'brand_id' => $discountRequest->discount_brand_id,
            'access_type_code' => $discountRequest->discounts_access_type_code
        ]);

        for ($i = 1; $i <= 3; $i++) {
            if ($discountRangeRequest->{'from_days_' . $i} && $discountRangeRequest->{'to_days_' . $i} !== null) {
                $discount->discountsRanges()->create([
                    'from_days' => $discountRangeRequest->{'from_days_' . $i},
                    'to_days' => $discountRangeRequest->{'to_days_' . $i},
                    'discount' => $discountRangeRequest->{'discount_percent_' . $i},
                    'code' => $discountRangeRequest->{'discount_code_' . $i},
                    'discount_id' => $discount->id
                ]);
            }
        }

        return redirect()->route('discount.index')->with('success', 'Descuento creado correctamente.');
    }

    public function destroy(Discount $discount)
    {
        $discount->delete();

        return redirect()->route('discount.index')->with('delete', 'Descuento eliminado correctamente.');
    }
}

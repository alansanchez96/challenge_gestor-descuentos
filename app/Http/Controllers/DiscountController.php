<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Http\Requests\DiscountRequest;
use App\Models\{Brand, Region, Discount, AccessType};
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DiscountController extends Controller
{
    public function index()
    {
        return view('discount.index');
    }

    public function create()
    {
        try {
            $brands         = Brand::select('id', 'name')->active()->orderBy('display_order', 'desc')->get();
            $accessTypes    = AccessType::select('code', 'name')->orderBy('display_order', 'desc')->get();
            $regions        = Region::select('id', 'name')->orderBy('display_order', 'desc')->get();
    
            return view('discount.create', compact('brands', 'accessTypes', 'regions'));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            abort(500);
        }
    }

    public function store(DiscountRequest $request)
    {
        try {
            if (isset($request->to_days_3) || isset($request->from_days_3)) {   // Verificamos si estos campos vienen completos
                if (is_null($request->to_days_2) && is_null($request->from_days_2)) {   // Si vienen llenos entonces verificamos que la aplicacion 2 también exista
                    // Si estas condiciones se cumplen, se activa una validacion
                    return redirect()->back()->withErrors(['failed' => 'La aplicacion 3 no puede llenarse sin la aplicacion 2'])->withInput();
                }
            }

            $discount = Discount::firstOrCreate([
                'name'              => $request->discounts_name,
                'start_date'        => $request->start_date,
                'end_date'          => $request->end_date,
                'priority'          => $request->discounts_priority,
                'active'            => $request->discounts_active,
                'region_id'         => $request->discounts_region_id,
                'brand_id'          => $request->discount_brand_id,
                'access_type_code'  => $request->discounts_access_type_code
            ]);

            if (!$discount) throw new ModelNotFoundException('Error al crear un nuevo descuento');
    
            for ($i = 1; $i <= 3; $i++) {
                if ($request->{'from_days_' . $i} && $request->{'to_days_' . $i} !== null) {
                    $discountRange = $discount->discountsRanges()->create([
                        'from_days'     => $request->{'from_days_'         . $i},
                        'to_days'       => $request->{'to_days_'           . $i},
                        'discount'      => $request->{'discount_percent_'  . $i},
                        'code'          => $request->{'discount_code_'     . $i},
                        'discount_id'   => $discount->id
                    ]);

                    if (!$discountRange) throw new ModelNotFoundException('Error al crear un nuevo descuento');
                }
            }

            return redirect()->route('discount.index')->with('success', 'Descuento creado correctamente.');
        } catch (ModelNotFoundException $e) {
            Log::error($e->getMessage());
            return redirect()->route('discount.index')->with('delete', $e->getMessage());
            // abort(500);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('discount.index')->with('delete', 'Error al crear un nuevo descuento');
            // abort(500);
        }
    }

    public function destroy(Discount $discount)
    {
        try {
            $discount->delete();
    
            return redirect()->route('discount.index')->with('delete', 'Descuento eliminado correctamente.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('discount.index')->with('delete', 'No se ha podido eliminar');
        }
    }
}

<?php

namespace App\Http\Livewire;

use App\Models\Brand;
use Livewire\Component;
use App\Models\Discount;

class ListDiscounts extends Component
{
    public $searchDiscount;
    public $searchCode;

    protected $listeners = ['reset' => 'resetFilters'];

    public function resetFilters()
    {
        $this->reset(['searchDiscount', 'searchCode']);
    }

    public function search()
    {
        $this->render();
    }

    public function render()
    {
        $brands = Brand::whereActive('1')
            ->orderBy('display_order')
            ->get();

        $discounts = Discount::with(['brand', 'discountsRanges'])
            ->whereHas('brand', fn ($query) => $query->whereActive('1'))
            ->where('discounts.name', 'LIKE', '%' . $this->searchDiscount . '%')
            ->orWhereHas('discountsRanges', fn ($query) => $query->where('code', 'LIKE', $this->searchCode))
            ->orderBy('discounts.name')
            ->paginate(5);

        return view('livewire.list-discounts', [
            'discounts' => $discounts,
            'brands' => $brands
        ]);
    }
}

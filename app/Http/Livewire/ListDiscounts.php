<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Exports\DiscountExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\{Brand, Region, Discount};

class ListDiscounts extends Component
{
    use WithPagination;

    public $brands, $brandFilter;
    public $regions, $regionFilter;
    public $searchDiscount, $searchCode;

    protected $listeners = [ 'reset' => 'resetFilters' ];

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->brands   = Brand::whereActive('1')->orderBy('display_order')->get();
        $this->regions  = Region::orderBy('display_order', 'asc')->get();
    }

    public function resetFilters()
    {
        $this->reset(['searchDiscount', 'searchCode', 'brandFilter', 'regionFilter']);
    }

    public function export()
    {
        $discounts = Discount::with(['brand', 'discountsRanges'])
        ->whereHas('brand',             fn ($q) => $q->whereActive('1'))
        ->when($this->brandFilter,      fn ($q) => $q->where('brand_id', $this->brandFilter))
        ->when($this->regionFilter,     fn ($q) => $q->where('region_id', $this->regionFilter))
        ->when($this->searchDiscount,   fn ($q) => $q->where('discounts.name', 'like', "%{$this->searchDiscount}%"))
        ->when($this->searchCode,       fn ($q) => $q->whereHas('discountsRanges', fn ($query) => $query->where('discount_ranges.code', 'like', $this->searchCode)))
        ->orderBy('discounts.name')
        ->get();

        return Excel::download(new DiscountExport($discounts), 'descuentos.csv');
    }

    public function search()
    {
        $this->render();
    }

    public function render()
    {
        $discounts = Discount::with(['brand', 'discountsRanges'])
        ->whereHas('brand',             fn ($q) => $q->whereActive('1'))
        ->when($this->brandFilter,      fn ($q) => $q->where('brand_id', $this->brandFilter))
        ->when($this->regionFilter,     fn ($q) => $q->where('region_id', $this->regionFilter))
        ->when($this->searchDiscount,   fn ($q) => $q->where('discounts.name', 'like', "%{$this->searchDiscount}%"))
        ->when($this->searchCode,       fn ($q) => $q->whereHas('discountsRanges', fn ($query) => $query->where('discount_ranges.code', 'like', $this->searchCode)))
        ->orderBy('discounts.name')
        ->paginate(5);

        return view('livewire.list-discounts', compact('discounts'));
    }
}

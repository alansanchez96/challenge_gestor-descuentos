<?php

namespace App\Http\Livewire;

use App\Models\Brand;
use App\Models\Region;
use Livewire\Component;
use App\Models\Discount;
use App\Exports\DiscountExport;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class ListDiscounts extends Component
{
    use WithPagination;

    public $brands;
    public $brandFilter;

    public $regions;
    public $regionFilter;

    public $searchDiscount;
    public $searchCode;

    protected $listeners = [
        'reset' => 'resetFilters',
    ];

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->brands = Brand::whereActive('1')->orderBy('display_order')->get();
        $this->regions = Region::orderBy('display_order', 'asc')->get();
    }

    public function resetFilters()
    {
        $this->reset(['searchDiscount', 'searchCode', 'brandFilter', 'regionFilter']);
    }

    public function export()
    {
        $discounts = Discount::with(['brand', 'discountsRanges'])
            ->whereHas('brand', fn ($query) => $query->whereActive('1'))
            ->when($this->brandFilter, fn ($query) => $query->where('brand_id', $this->brandFilter))
            ->when($this->regionFilter, fn ($query) => $query->where('region_id', $this->regionFilter))
            ->when($this->searchDiscount, fn ($query) => $query->where('discounts.name', 'like', '%' . $this->searchDiscount . '%'))
            ->when(
                $this->searchCode,
                fn ($query) => $query->whereHas(
                    'discountsRanges',
                    fn ($query) => $query->where(
                        'discount_ranges.code',
                        'like',
                        $this->searchCode
                    )
                )
            )
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
            ->whereHas('brand', fn ($query) => $query->whereActive('1'))
            ->when($this->brandFilter, fn ($query) => $query->where('brand_id', $this->brandFilter))
            ->when($this->regionFilter, fn ($query) => $query->where('region_id', $this->regionFilter))
            ->when($this->searchDiscount, fn ($query) => $query->where('discounts.name', 'like', '%' . $this->searchDiscount . '%'))
            ->when(
                $this->searchCode,
                fn ($query) => $query->whereHas(
                    'discountsRanges',
                    fn ($query) => $query->where(
                        'discount_ranges.code',
                        'like',
                        $this->searchCode
                    )
                )
            )
            ->orderBy('discounts.name')
            ->paginate(5);

        return view('livewire.list-discounts', [
            'discounts' => $discounts
        ]);
    }
}

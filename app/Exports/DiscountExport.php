<?php

namespace App\Exports;

use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class DiscountExport implements FromView
{
    use Exportable;

    protected $discounts;

    public function __construct($discounts)
    {
        $this->discounts = $discounts;
    }

    public function view(): View
    {
        return view(
            'discount.export',
            [
                'discounts' => $this->discounts
            ]
        );
    }
}

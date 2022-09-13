<?php

namespace App\Services\Products\Exports;

use App\Services\Products\Exports\ProductsExcelSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ProductsToExcelExport implements WithMultipleSheets
{
    use Exportable;

    public function sheets(): array
    {
        return [
            new ProductsExcelSheet()
        ];
    }
}

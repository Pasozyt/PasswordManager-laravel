<?php

namespace App\Services\Products\Exports;

use App\Services\Products\Exports\ProductsToExcelExport;
use App\Services\Products\Exports\ProductsToPdfExport;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Facades\Excel as ExcelFacade;

class ExportProductsService
{
    public static function downloadExcel(string $fileTitle)
    {
        return ExcelFacade::download(
            new ProductsToExcelExport(),
            $fileTitle . '.xlsx',
            Excel::XLSX
        );
    }

    public static function downloadPdf(string $fileTitle)
    {
        return ExcelFacade::download(
            new ProductsToPdfExport(),
            $fileTitle . '.pdf',
            Excel::MPDF
        );
    }
}

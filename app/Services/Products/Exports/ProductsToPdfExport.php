<?php

namespace App\Services\Products\Exports;

use App\Services\Products\Exports\ProductsPdfSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\BeforeWriting;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;

class ProductsToPdfExport implements WithMultipleSheets, WithEvents
{
    use Exportable;

    public function sheets(): array
    {
        return [
            new ProductsPdfSheet()
        ];
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            BeforeExport::class => function (BeforeExport $event) {
            },

            BeforeWriting::class => function (BeforeWriting $event) {
                $event->getWriter()->getDelegate()->getActiveSheet()->getPageSetup()->setPaperSize(PageSetup::PAPERSIZE_A4);
                $event->getWriter()->getDelegate()->getActiveSheet()->getPageSetup()->setOrientation(PageSetup::ORIENTATION_LANDSCAPE);
            },
        ];
    }
}

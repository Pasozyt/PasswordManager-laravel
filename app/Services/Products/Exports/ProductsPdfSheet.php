<?php

namespace App\Services\Products\Exports;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeSheet;
use PhpOffice\PhpSpreadsheet\Style\Border;

class ProductsPdfSheet extends ProductsSheet implements
    WithEvents
{
    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            BeforeSheet::class => function (BeforeSheet $event) {
            },

            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A1:H1')->getFont()->setBold(true);
                $event->sheet->getDelegate()->getColumnDimension('A')->setAutoSize(true);
                $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(20);
                $event->sheet->getStyle('B1:B' . $event->sheet->getHighestRow())
                    ->getAlignment()->setWrapText(true);
                $event->sheet->getDelegate()->getColumnDimension('C')->setWidth(30);
                $event->sheet->getStyle('C1:C' . $event->sheet->getHighestRow())
                    ->getAlignment()->setWrapText(true);
                $event->sheet->getDelegate()->getColumnDimension('D')->setAutoSize(true);
                $event->sheet->getDelegate()->getColumnDimension('E')->setWidth(20);
                $event->sheet->getStyle('E1:E' . $event->sheet->getHighestRow())
                    ->getAlignment()->setWrapText(true);
                $event->sheet->getDelegate()->getColumnDimension('F')->setWidth(15);
                $event->sheet->getStyle('F1:F' . $event->sheet->getHighestRow())
                    ->getAlignment()->setWrapText(true);
                $event->sheet->getDelegate()->getColumnDimension('G')->setWidth(15);
                $event->sheet->getStyle('G1:G' . $event->sheet->getHighestRow())
                    ->getAlignment()->setWrapText(true);
                $event->sheet->getDelegate()->getColumnDimension('H')->setWidth(15);
                $event->sheet->getStyle('H1:H' . $event->sheet->getHighestRow())
                    ->getAlignment()->setWrapText(true);

                $event->sheet->getDelegate()->getStyle('A1:H' . $event->sheet->getHighestRow())
                    ->getBorders()->getAllBorders()
                    ->setBorderStyle(Border::BORDER_THIN);
            }
        ];
    }
}

<?php

namespace App\Services\Products\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Events\BeforeWriting;

class ProductsExport implements
    FromCollection,
    WithEvents,
    WithHeadings,
    WithMapping
{
    public function collection()
    {
        return Product::withTrashed()
            ->with('category')
            ->with('manufacturers')
            ->get();
    }

    public function headings(): array
    {
        return [
            '#',
            __('translations.products.attribute.name'),
            __('translations.products.attribute.description'),
            __('translations.products.attribute.category'),
            __('translations.products.attribute.manufacturers'),
            __('translations.attribute.created_at'),
            __('translations.attribute.updated_at'),
            __('translations.attribute.deleted_at'),
        ];
    }

    public function map($product): array
    {
        return [
            $product->id,
            $product->name,
            $product->description,
            $product->category->name,
            $product->manufacturers->implode('name', ', '),
            $product->created_at,
            $product->updated_at,
            $product->deleted_at
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
            },

            BeforeSheet::class => function (BeforeSheet $event) {
            },

            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A1:H1')->getFont()->setBold(true);
                $event->sheet->getDelegate()->getColumnDimension('A')->setAutoSize(true);
                $event->sheet->getDelegate()->getColumnDimension('B')->setAutoSize(true);
                $event->sheet->getDelegate()->getColumnDimension('C')->setWidth(100);
                $event->sheet->getStyle('C1:C' . $event->sheet->getHighestRow())
                    ->getAlignment()->setWrapText(true);
                $event->sheet->getDelegate()->getColumnDimension('D')->setAutoSize(true);
                $event->sheet->getDelegate()->getColumnDimension('E')->setAutoSize(true);
                $event->sheet->getDelegate()->getColumnDimension('F')->setAutoSize(true);
                $event->sheet->getDelegate()->getColumnDimension('G')->setAutoSize(true);
                $event->sheet->getDelegate()->getColumnDimension('H')->setAutoSize(true);
            }
        ];
    }
}

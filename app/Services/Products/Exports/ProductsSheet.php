<?php

namespace App\Services\Products\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;


class ProductsSheet implements
    FromCollection,
    WithHeadings,
    WithMapping,
    WithTitle
{
    public function title(): string
    {
        return __('translations.products.title');
    }

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
}

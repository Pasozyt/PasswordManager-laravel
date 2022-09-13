<?php

namespace App\Services\DataTables;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\ComponentAttributeBag;
use Yajra\DataTables\Facades\DataTables;
use Yajra\DataTables\Services\DataTable;


class ProductDataTable extends DataTable
{
    /**
     * Filtry kolumn
     * @var array
     */
    const SQL_RAW_FILTER = [
        'created_at' => "DATE_FORMAT(products.created_at,'%Y-%m-%d')",
        'updated_at' => "DATE_FORMAT(products.updated_at,'%Y-%m-%d %H:%i')",
        'deleted_at' => "DATE_FORMAT(products.deleted_at,'%d-%m-%Y')",
    ];

    public function ajax()
    {
        $datatable = DataTables::eloquent($this->query())
            ->editColumn('manufacturers', function ($product) {
                $manufacturers = $product->manufacturers;
                foreach ($manufacturers as &$manufacturer) {
                    $manufacturersAsString = '<span class="badge bg-light text-dark">'
                        . htmlspecialchars($manufacturer->name)
                        . ' - '
                        . htmlspecialchars(
                            number_format($manufacturer->pivot->price, 2)
                        )
                        . ' ' . __('translations.labels.pln')
                        . '</span>';
                    $manufacturer->name = $manufacturersAsString;
                }
                return json_decode($manufacturers);
            })
            ->editColumn('created_at', function ($row) {
                return $row->created_at
                    ? with(new Carbon($row->created_at))->format('Y-m-d')
                    : '';
            })
            ->editColumn('updated_at', function ($row) {
                return $row->updated_at
                    ? with(new Carbon($row->updated_at))->format('Y-m-d H:i')
                    : '';
            })
            ->editColumn('deleted_at', function ($row) {
                return $row->deleted_at
                    ? with(new Carbon($row->deleted_at))->format('d-m-Y')
                    : '';
            })
            ->filter(function ($query) {
                $search = request('search');
                $keyword = $search['value'];
                if (strlen($keyword) === 0) {
                    return;
                }
                $keyword = "%$keyword%";
                $query->where('products.id', 'like', $keyword);
                $query->orWhere('products.name', 'like', $keyword);
                $query->orWhere('products.description', 'like', $keyword);
                $query->orWhereHas('category', function ($query) use ($keyword) {
                    return $query->where('categories.name', 'like', $keyword);
                });
                $query->orWhereHas('manufacturers', function ($query) use ($keyword) {
                    return $query->where('manufacturers.name', 'like', $keyword)->orWhere('price', 'like', $keyword);
                });
                $query->orWhereRaw(self::SQL_RAW_FILTER['created_at'] . ' LIKE ?', ["%$keyword%"]);
                $query->orWhereRaw(self::SQL_RAW_FILTER['updated_at'] . ' LIKE ?', ["%$keyword%"]);
                $query->orWhereRaw(self::SQL_RAW_FILTER['deleted_at'] . ' LIKE ?', ["%$keyword%"]);
            })
            ->addColumn('action', function ($row) {
                return $this->getActionButtons($row);
            })
            ->rawColumns(['action']);

        return $datatable->make(true);
    }

    public function query()
    {
        $rows = Product::withTrashed()
            ->with('category', 'manufacturers')
            ->select('products.*');
        return $this->applyScopes($rows);
    }

    private function getActionButtons(Product $product): string
    {
        $buttons = '<div class="btn-group" role="group" aria-label="action buttons">';
        $buttons .= $this->getEditButton($product);
        $buttons .= $this->getDestroyButton($product);
        $buttons .= $this->getRestoreButton($product);

        $buttons .= '</div>';
        return $buttons;
    }

    private function getEditButton(Product $product): string
    {
        if (isset($product->deleted_at)) {
            return '';
        }
        if (!Auth::user()->can('product.store')) {
            return '';
        }
        return view('components.datatables.action-link', [
            'slot' => '<i class="bi-pencil"></i>',
            'attributes' => new ComponentAttributeBag([
                'url' => route('products.edit', $product),
                'title' =>  __('translations.manufacturers.labels.edit'),
                'class' => 'btn btn-primary'
            ])
        ])->render();
    }

    private function getDestroyButton(Product $product): string
    {
        if (isset($product->deleted_at)) {
            return '';
        }
        if (!Auth::user()->can('product.store')) {
            return '';
        }
        return view('components.datatables.confirm', [
            'slot' => '<i class="bi bi-trash"></i>',
            'attributes' => new ComponentAttributeBag([
                'action' => route('products.destroy', $product),
                'method' => 'DELETE',
                'confirm-text' => __('translations.buttons.yes'),
                'confirm-class' => 'btn btn-danger me-2',
                'cancel-text' => __('translations.buttons.no'),
                'cancel-class' => 'btn btn-secondary ms-2',
                'icon' => 'question',
                'message' => __('translations.products.labels.destroy-question', ['name' => $product->name]),
                'button-class' => 'btn btn-danger',
                'button-title' => __('translations.products.labels.destroy')
            ])
        ])->render();
    }

    private function getRestoreButton(Product $product): string
    {
        if (!isset($product->deleted_at)) {
            return '';
        }
        if (!Auth::user()->can('product.store')) {
            return '';
        }
        return view('components.datatables.confirm', [
            'slot' => '<i class="bi bi-trash"></i>',
            'attributes' => new ComponentAttributeBag([
                'action' => route('products.restore', $product),
                'method' => 'PUT',
                'confirm-text' => __('translations.buttons.yes'),
                'confirm-class' => 'btn btn-success me-2',
                'cancel-text' => __('translations.buttons.no'),
                'cancel-class' => 'btn btn-secondary ms-2',
                'icon' => 'question',
                'message' => __('translations.products.labels.restore-question', ['name' => $product->name]),
                'button-class' => 'btn btn-success',
                'button-title' => __('translations.products.labels.restore')
            ])
        ])->render();
    }
}

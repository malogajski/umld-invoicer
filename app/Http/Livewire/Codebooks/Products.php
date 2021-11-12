<?php

namespace App\Http\Livewire\Codebooks;

use App\Models\Codebooks\Product;
use App\Models\Codebooks\ProductCategory;
use Livewire\Component;
use Livewire\WithPagination;

class Products extends Component
{
    use WithPagination;

    public $categories = [];
    public $sortColumn = 'name';
    public $sortDirection = 'asc';
    public $searchColumns = [
        'id' => '',
        'name' => '',
        'price' => ['', ''],
        'description' => '',
        'product_category_id' => 0,
    ];

    public $showModal = false;
    public $productId;
    public $product;
    protected $rules = [
        'product.name' => 'required',
        'product.description' => 'nullable|string|max:255',
        'product.price' => 'required|numeric',
        'product.tax' => 'required|numeric|min:0|max:40',
        'product.product_category_id' => 'nullable',
    ];

    protected $listeners = [
        'updateCategories' => 'mount',
    ];

    public $designTemplate = 'tailwind';

    public function mount()
    {
        $this->categories = ProductCategory::select('id', 'name')->get();
//        $this->categories = ProductCategory::pluck('name', 'id');
    }

    public function sortByColumn($column)
    {
        if ($this->sortColumn == $column) {
            $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
        } else {
            $this->reset('sortDirection');
            $this->sortColumn = $column;
        }
    }

    public function updating($value, $name)
    {
        $this->resetPage();
    }

    public function render()
    {
        $products = Product::select([
            'products.id',
            'products.name',
            'price',
            'description',
            'product_categories.name as category_name',
            'product_category_id',
        ])
            ->leftJoin('product_categories',
                'products.product_category_id',
                '=',
                'product_categories.id');

        foreach ($this->searchColumns as $column => $value) {
            if (!empty($value)) {
                if ($column == 'price') {
                    if (is_numeric($value[0])) {
                        $products->where($column, '>', $value[0]);
                    }
                    if (is_numeric($value[1])) {
                        $products->where($column, '<', $value[1]);
                    }
                } else if ($column == 'product_category_id') {
                    $products->where($column, $value);
                } else {
                    $products->where('products.' . $column, 'LIKE', '%' . $value . '%');
                }
            }
        }

        $products->orderBy($this->sortColumn, $this->sortDirection);

        return view('livewire.codebooks.products', [
            'products' => $products->paginate(5)
        ]);
    }

    public function edit($productId)
    {
        $this->showModal = true;
        $this->productId = $productId;
        $this->product = Product::find($productId);
    }

    public function create()
    {
        $this->showModal = true;
        $this->product = null;
        $this->productId = null;
    }

    public function save()
    {
        $this->product['host_id'] = auth()->user()->host_id;
//        $this->product['user_id'] = auth()->user()->id;

        $this->validate();
//dd($this->product);
        if (!is_null($this->productId)) {
            $this->product->save();
        } else {
            Product::create($this->product);
        }

        $this->showModal = false;
    }

    public function close()
    {
        $this->showModal = false;
    }

    public function delete($productId)
    {
        $product = Product::find($productId);
        if ($product) {
            $product->delete();
        }
    }
}

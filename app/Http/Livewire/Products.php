<?php

namespace App\Http\Livewire;

use App\Models\Codebooks\Product;
use Livewire\Component;

class Products extends Component
{
    public $editedProductIndex = null;
    public $editedProductField = null;
    public $products = [];

    public $designTemplate = 'bootstrap';

    protected $rules = [
        'products.*.name' => ['required'],
        'products.*.price' => ['required', 'numeric'],
    ];

    protected $validationAttributes = [
        'products.*.name' => 'Name',
        'products.*.price' => 'Price',
    ];

    public function mount()
    {
        $this->products = Product::all()->toArray();
    }

    public function render()
    {
        return view('livewire.products', [
            'products' => $this->products
        ]);
    }

    public function editProduct($productIndex)
    {
        $this->editedProductIndex = $productIndex;
    }

    public function editProductField($productIndex, $fieldName)
    {
        $this->editedProductField = $productIndex . '.' . $fieldName;
    }

    public function saveProduct($productIndex)
    {
        $this->validate();

        $product = $this->products[$productIndex] ?? NULL;
        if (!is_null($product)) {
            optional(Product::find($product['id']))->update($product);
        }
        $this->editedProductIndex = null;
        $this->editedProductField = null;
    }
}

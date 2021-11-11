<?php

namespace App\Http\Livewire\Components;

use App\Models\Codebooks\Associate;
use App\Models\Codebooks\Product;
use App\Models\Invoices\Invoice;
use App\Models\Invoices\InvoiceDetail;
use App\Models\Invoices\InvoiceType;
use Livewire\Component;

class SearchProduct extends Component
{
    public $searchProduct;
    public $products = [];
    public $list = [];
    public $results;
    public $total;
    public $associates = [];
    public $types = [];
    public Invoice $invoice;
    public $associate_id;
    public $type;

    protected $rules = [
        'associates' => 'required|array'
    ];


    public function mount()
    {
        $this->associates = Associate::all();
        $this->types = InvoiceType::all();
        $this->searchProduct = '';
        $this->total = 0.00;
    }

    public function render()
    {
        if ($this->searchProduct != '') {
            $this->products = Product::when($this->searchProduct != '', function ($query) {
                $query->where('name', 'like', '%' . $this->searchProduct . '%');
            })->get();
        } else {
            $this->products = [];
            $this->searchProduct = '';
            $this->total = 0.00;
        }

        if (!empty($this->list)) {
            $item_total = [];
            foreach ($this->list as $calc) {
                $item_total[] = floatval($calc['price']) * floatval($calc['quantity']);
            }
            $this->total = floatval(array_sum($item_total));
        }

        return view('livewire.components.search-product', ['products' => $this->products]);
    }

    public function selectedProduct($id)
    {
        $product = Product::find($id);
        $this->list[] = [
            'id' => $product->id,
            'name' => $product->name,
            'price' => floatval($product->price),
            'quantity' => floatval(1),
            'total' => floatval($product->price)
        ];

        $this->products = [];
        $this->searchProduct = '';
        $this->results = '';
    }

    public function saveItems($index)
    {
//        $this->resetErrorBag();
//        $product = $this->products->find($this->list[$index]['product_id']);
//        $this->list[$index]['name'] = $product->name;
//        $this->list[$index]['price'] = $product->price;
//        $this->list[$index]['is_saved'] = true;
    }

    public function removeProduct($index)
    {
        unset($this->list[$index]);
        $this->list = array_values($this->list);
    }

    public function saveInvoice()
    {
        $number = Invoice::max('number');

        $invoice = Invoice::create([
            'host_id' => 1,
            'type' => $this->type,
            'number' => $number+1,
            'associate_id' => $this->associate_id,
            'date' => $this->date,
            'due_date' => $this->due_date,
            'user_id' => 1,
        ]);

        foreach ($this->invoiceProducts as $product) {
            InvoiceDetail::create(
                [
                    'host_id' => 1,
                    'parent_id' => $invoice->id,
                    'product_id' => $product['product_id'],
                    'quantity' => $product['quantity'],
                    'price' => $product['product_price'],
                    'total_without_tax' => $product['quantity'] * $product['product_price'],
                    'tax' => 0,
                    'total' => $product['quantity'] * $product['product_price'],
                ]);
        }

        $this->reset('invoiceProducts', 'customer_name', 'customer_email');
        $this->invoiceSaved = true;
    }
}

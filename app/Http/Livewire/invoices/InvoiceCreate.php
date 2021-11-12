<?php

namespace App\Http\Livewire\Invoices;

use App\Models\Codebooks\Associate;
use App\Models\Codebooks\Product;
use App\Models\Invoices\Invoice;
use App\Models\Invoices\InvoiceDetail;
use App\Models\Invoices\InvoiceType;
use Carbon\Carbon;
use Livewire\Component;

class InvoiceCreate extends Component
{
    public $searchProduct;
    public $products = [];
    public $list = [];
    public $results;
    public $total;
    public $associates = [];
    public $types = [];
    public $invoice;
    public $associate_id;
    public $type;
    public $date;
    public $due_date;
    public $number;
    public $sub_total;
    public $tax_total;
//    public $totals = [];


    protected $rules = [
        'associates' => 'required|array',
    ];


    public function mount(Invoice $invoice)
    {
//        dd($invoice);
        $this->invoice = $invoice ?? new Invoice();
        $this->associate_id = $invoice->associate_id ?? null;
        $this->type = $invoice->type ?? null;
        $this->number = $invoice->number ?? 0;
        if ($invoice->details()) {
            $this->list = $invoice->details()->get()->toArray();
        }
//        dd($this->list);
        $this->associates = Associate::all();
        $this->types = InvoiceType::all();
        $this->searchProduct = '';
        $this->total = 0.00;
        $this->date = date_format(Carbon::now(), 'Y-m-d');
        $this->due_date = date_format(Carbon::now()->addDays(15), 'Y-m-d');
//        $this->totals = [
//            'sub_total' => 0,
//            'tax_total' => 0,
//            'grand_total' => 0
//        ];
    }

    public function render()
    {
        // Search box TODO: move this into component!
        if ($this->searchProduct != '') {
            $this->products = Product::when($this->searchProduct != '', function ($query) {
                $query->where('name', 'like', '%' . $this->searchProduct . '%');
            })->get();
        } else {
            $this->products = [];
            $this->searchProduct = '';
            $this->total = 0.00;
        }

        // TEMP ARRAY - Invoice items TODO: Save this into temp (cart) table
        if (!empty($this->list)) {
            $item_total = [];
            $item_sub_total = [];
            $item_tax_total = [];
            foreach ($this->list as $calc) {

                $sub_total = floatval($calc['price']) * floatval($calc['quantity']);
                $tax_total = $calc['tax'] > 0 ? $sub_total * ($calc['tax'] / 100) : 0;
                $item_sub_total[] = $sub_total;
                $item_tax_total[] = $tax_total;
                $item_total[] = $sub_total + $tax_total;
            }
            $this->sub_total = floatval(array_sum($item_sub_total));
            $this->tax_total = floatval(array_sum($item_tax_total));
            $this->total = floatval(array_sum($item_total));
        }

//        return view('livewire.components.search-product', ['products' => $this->products]);
        return view('livewire.invoices.invoice-create', ['products' => $this->products]);
    }

    public function selectedProduct($id)
    {
        $product = Product::find($id);
        $fake_id = count($this->list) ?? 0;
        $this->list[] = [
            'id'         => null,
            'product_id' => $product->id,
            'name'       => $product->name,
            'price'      => floatval($product->price),
            'tax'        => floatval($product->tax),
            'tax_total'  => 0,
            'sub_total'  => 0,
            'quantity'   => floatval(1),
            'total'      => floatval($product->price),
        ];
//dd($this->list);
        $this->products = [];
        $this->searchProduct = '';
        $this->results = '';
    }

    public function saveItems($index)
    {
        // TODO: Here save temporary invoice items
//        $this->resetErrorBag();
//        $product = $this->products->find($this->list[$index]['product_id']);
//        $this->list[$index]['name'] = $product->name;
//        $this->list[$index]['price'] = $product->price;
//        $this->list[$index]['is_saved'] = true;
    }

    public function removeProduct($index)
    {
        if (isset($this->list[$index]['id']) && intval($this->list[$index]['id']) > 0) {
            InvoiceDetail::destroy([$this->list[$index]['id']]);
        }
        unset($this->list[$index]);
        $this->list = array_values($this->list);
    }

    private function createItems($list_item)
    {
        InvoiceDetail::create(
            [
                'host_id'           => 1,
                'parent_id'         => $this->invoice->id,
                'product_id'        => $list_item['product_id'],
                'quantity'          => $list_item['quantity'],
                'price'             => $list_item['price'],
                'total_without_tax' => $list_item['quantity'] * $list_item['price'],
                'tax'               => 0,
                'total'             => $list_item['quantity'] * $list_item['price'],
            ]);
    }

    public function saveInvoice()
    {
        if ($this->invoice->id) {

            Invoice::where('id', $this->invoice->id)->update([
                'host_id'      => 1,
                'type'         => $this->type,
                'number'       => $this->number,
                'associate_id' => $this->associate_id,
                'date'         => $this->date,
                'due_date'     => $this->due_date,
                'user_id'      => 1,
                'sub_total'    => $this->sub_total,
                'tax_total'    => $this->tax_total,
                'total'        => $this->total,
            ]);

            foreach ($this->list as $product) {

                if ($product['id'] === null) {
                    $this->createItems($product);
                    continue;
                }

                InvoiceDetail::where('id', $product['id'])
                    ->where('parent_id', $this->invoice->id)
                    ->update(
                        [
                            'product_id'        => $product['product_id'],
                            'quantity'          => $product['quantity'],
                            'price'             => $product['price'],
                            'total_without_tax' => $product['quantity'] * $product['price'],
                            'tax'               => 0,
                            'total'             => $product['quantity'] * $product['price'],
                        ]);
            }
        } else {

            $invoice = Invoice::create([
                'host_id'      => 1,
                'type'         => $this->type,
                'number'       => $this->number,
                'associate_id' => $this->associate_id,
                'date'         => $this->date,
                'due_date'     => $this->due_date,
                'user_id'      => 1,
                'sub_total'    => $this->sub_total,
                'tax_total'    => $this->tax_total,
                'total'        => $this->total,
            ]);

            foreach ($this->list as $product) {
                InvoiceDetail::create(
                    [
                        'host_id'           => 1,
                        'parent_id'         => $invoice->id,
                        'product_id'        => $product['product_id'],
                        'quantity'          => $product['quantity'],
                        'price'             => $product['price'],
                        'total_without_tax' => $product['quantity'] * $product['price'],
                        'tax'               => 0,
                        'total'             => $product['quantity'] * $product['price'],
                    ]);
            }
        }
//        dd('done');
        $this->reset('list', 'associates', 'type', 'number', 'date', 'due_date');
//        $this->invoiceSaved = true;
    }

    /*
    public $invoiceProducts = [];
    public $associates = [];
    public $allProducts = [];
    public $associate_id;
    public $date;
    public $due_date;
    public $invoice_no;
    public $taxes = 20;
    public $customer_name;
    public $customer_email;
    public $invoiceSaved = false;

    protected $rules = [
        'associates' => 'required|array'
    ];

    public function mount()
    {
        $this->allProducts = Product::all();
        $this->associates = Associate::all();
        $this->date = Carbon::now();
        $this->due_date = Carbon::now()->addDays(15);
    }

    public function render()
    {
        $total = 0;

        foreach ($this->invoiceProducts as $invoiceProduct) {
            if ($invoiceProduct['is_saved'] && $invoiceProduct['product_price'] && $invoiceProduct['quantity']) {
                $total += $invoiceProduct['product_price'] * $invoiceProduct['quantity'];
            }
        }

        return view('', [
            'subtotal' => $total,
            'total' => $total * (1 + (is_numeric($this->taxes) ? $this->taxes : 0) / 100)
        ]);
    }

    public function addProduct()
    {
        foreach ($this->invoiceProducts as $key => $invoiceProduct) {
            if (!$invoiceProduct['is_saved']) {
                $this->addError('invoiceProducts.' . $key, 'This line must be saved before creating a new one.');
                return;
            }
        }

        $this->invoiceProducts[] = [
            'product_id' => '',
            'quantity' => 1,
            'is_saved' => false,
            'product_name' => '',
            'product_price' => 0,
        ];

        $this->invoiceSaved = false;
    }

    public function editProduct($index)
    {
        foreach ($this->invoiceProducts as $key => $invoiceProduct) {
            if (!$invoiceProduct['is_saved']) {
                $this->addError('invoiceProducts.' . $key, 'This line must be saved before editing another.');
                return;
            }
        }

        $this->invoiceProducts[$index]['is_saved'] = false;
    }

    public function saveProduct($index)
    {
        $this->resetErrorBag();
        $product = $this->allProducts->find($this->invoiceProducts[$index]['product_id']);
        $this->invoiceProducts[$index]['product_name'] = $product->name;
        $this->invoiceProducts[$index]['product_price'] = $product->price;
        $this->invoiceProducts[$index]['is_saved'] = true;
    }

    public function removeProduct($index)
    {
        unset($this->invoiceProducts[$index]);
        $this->invoiceProducts = array_values($this->invoiceProducts);
    }

    public function saveInvoice()
    {
        $number = Invoice::where('deleted_at', 'not null')->max('number');

        $invoice = Invoice::create([
//            'customer_name' => $this->customer_name,
//            'customer_email' => $this->customer_email,
            'host_id' => 1,
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
*/
}

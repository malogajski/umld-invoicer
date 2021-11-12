<?php

namespace App\Http\Livewire\Invoices;

use Livewire\Component;

class Invoices extends Component
{
    public $editedProductIndex = null;
    public $editedProductField = null;
    public $products = [];

    public function render()
    {
        return view('livewire.invoices.invoices', [
            'invoices'
        ]);
    }
}

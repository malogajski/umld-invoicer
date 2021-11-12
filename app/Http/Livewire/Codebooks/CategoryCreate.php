<?php

namespace App\Http\Livewire\Codebooks;

use Livewire\Component;
use App\Models\Codebooks\ProductCategory;

class CategoryCreate extends Component
{
    public $showModal = false;
    public $name = '';

    protected $listeners = ['openModal' => 'openModal'];

    protected $rules = [
        'name' => 'required|min:3|unique:product_categories,name',
    ];

    public function render()
    {
        return view('livewire.codebooks.category-create');
    }

    public function save()
    {
        $this->validate();

        ProductCategory::create([
            'name' => $this->name
        ]);

        $this->reset('name');

        $this->emit('updateCategories');

        $this->closeModal();
    }

    public function openModal()
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }
}

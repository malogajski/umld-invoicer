<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class Host extends Component
{
    public $hosts = [];

    public function mount()
    {
        $this->hosts = \App\Models\Host::all(); //where('id', auth()->user()->host_id)->get();
    }

    public function render()
    {
        return view('livewire.admin.host');
    }

    public function saveHost()
    {
        dd('Form submit');
    }
}

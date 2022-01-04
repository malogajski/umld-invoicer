<?php

namespace App\Http\Livewire\Codebooks;

use App\Enums\Codebooks\AssociateStatus;
use App\Enums\Codebooks\AssociateType;
use App\Models\Codebooks\Country;
use Livewire\Component;

class AssociatesCreate extends Component
{
    public $countries;
    public $types;
    public $statuses;

    public function mount()
    {
        $this->countries = Country::all();
        $this->types = AssociateType::asArray();
        $this->statuses = AssociateStatus::asArray();
    }

    public function render()
    {

        return view('livewire.codebooks.associates-create');
    }
}

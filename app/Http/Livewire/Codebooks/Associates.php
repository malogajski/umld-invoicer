<?php

namespace App\Http\Livewire\Codebooks;

use App\Enums\Codebooks\AssociateStatus;
use App\Enums\Codebooks\AssociateType;
use App\Models\Codebooks\Associate;
use App\Models\Codebooks\City;
use App\Models\Codebooks\Country;
use App\Models\Codebooks\State;
use Livewire\Component;
use Livewire\WithPagination;

class Associates extends Component
{
    use WithPagination;

    public $cities = [];
    public $states = [];
    public $countries = [];

    public $country_id;
    public $state_id;
    public $city_id;
    public $selectedCity;

    protected $listeners = ['city_changed' => 'city_changed'];

    public $sortColumn = 'name';
    public $sortDirection = 'asc';
    public $searchColumns = [
        'id'      => '',
        'name'    => '',
        'address' => '',
        'city_id' => '',
    ];

    public $showModal = false;
    public $associate;
    public $associateId;

    protected $rules = [
        'associate.name'    => 'required',
        'associate.address' => 'required',
        'associate.type'    => 'required',
        'associate.status'  => 'required',
        'associate.phone'   => 'nullable',
        'associate.mobile'   => 'nullable',
    ];

    public $designTemplate = 'tailwind';

    public function render()
    {
        $associates = Associate::with(['city', 'state', 'country']);

        $this->types = AssociateType::asArray();
        $this->statuses = AssociateStatus::asArray();


        foreach ($this->searchColumns as $column => $value) {
            if (!empty($value)) {
                if ($column == 'city_id') {
                    $associates->where($column, $value);
                } else {
                    $associates->where('associates.' . $column, 'LIKE', '%' . $value . '%');
                }
            }
        }

        $associates->orderBy($this->sortColumn, $this->sortDirection);

        // For filter -> Get only cities, states and countries that exists in associates
        $this->cities = City::whereIn('id', $associates->pluck('city_id')->toArray())->get();
        $this->states = State::whereIn('id', $associates->pluck('state_id')->toArray())->get();
        $this->countries = Country::whereIn('id', $associates->pluck('country_id')->toArray())->get();

        return view('livewire.codebooks.associates', [
            'associates' => $associates->paginate(5),
            'cities'     => $this->cities,
            'states'     => $this->states,
            'countries'  => $this->countries,
        ]);
    }

    public function city_changed($csc_component)
    {
        $this->city_id = $csc_component['city_id'];
        $this->state_id = $csc_component['state_id'];
        $this->country_id = $csc_component['country_id'];
    }

    public function mount()
    {
        //
    }

    public function edit($associateId)
    {
        $this->showModal = true;
        $this->associateId = $associateId;
        $this->associate = Associate::find($associateId);
        $this->selectedCity = $this->associate->city_id;
    }

    public function create()
    {
        $this->selectedCity = null;
        $this->showModal = true;
        $this->associate = null;
        $this->associateId = null;
    }

    public function save()
    {
        $this->associate['host_id'] = auth()->user()->host_id;
        $this->associate['city_id'] = $this->city_id;
        $this->associate['state_id'] = $this->state_id;
        $this->associate['country_id'] = $this->country_id;

        $this->validate();

        if (!is_null($this->associateId)) {
            $this->associate->save();
        } else {
            Associate::create($this->associate);
        }

        $this->showModal = false;
        $this->selectedCity = null;
    }

    public function close()
    {
        $this->showModal = false;
        $this->selectedCity = null;
    }

    public function delete($associateId)
    {
        $associate = Associate::find($associateId);
        if ($associate) {
            $associate->delete();
        }
    }
}

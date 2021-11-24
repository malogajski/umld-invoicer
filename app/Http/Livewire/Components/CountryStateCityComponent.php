<?php

namespace App\Http\Livewire\Components;

use App\Enums\Codebooks\AssociateStatus;
use App\Enums\Codebooks\AssociateType;
use App\Models\Codebooks\City;
use App\Models\Codebooks\Country;
use App\Models\Codebooks\State;
use Livewire\Component;

class CountryStateCityComponent extends Component
{
    public $countries = [];
    public $states = [];
    public $cities = [];
    public $selectedCity = null;
    public $selectedState = null;
    public $selectedCountry = null;

    protected $rules = [
        'selectedState' => 'nullable'
    ];

    public function render()
    {
        return view('livewire.components.country-state-city-component');
    }

    public function mount($selectedCity = null)
    {
        $this->countries = Country::all();
        $this->types = collect();
        $this->statuses = collect();
        $this->selectedCity = $selectedCity;

        if (!is_null($selectedCity)) {
            $city = City::with('state.country')->find($selectedCity);

            if ($city) {
                $this->cities = City::where('state_id', $city->state_id)->get();
                $this->states = State::where('country_id', $city->state->country_id)->get();
                $this->selectedCountry = $city->state->country_id;
                $this->selectedState = $city->state_id;
            }
        }
    }

    public function changeCountry()
    {
        $this->states = State::where('country_id', $this->selectedCountry)->get();
        $this->selectedState = null;
        $this->selectedCity = null;
    }

    public function changeState()
    {
        $this->cities = City::where('state_id', $this->selectedState)->get();
    }

    public function changeCity()
    {
        if (empty($this->selectedCity)) return;
        $this->emit('city_changed', [
            'city_id' => $this->selectedCity,
            'state_id' => $this->selectedState,
            'country_id' => $this->selectedCountry
        ]);
    }
}

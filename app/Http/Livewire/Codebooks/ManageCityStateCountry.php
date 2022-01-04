<?php

namespace App\Http\Livewire\Codebooks;

use App\Models\Codebooks\City;
use App\Models\Codebooks\Country;
use App\Models\Codebooks\State;
use Livewire\Component;

class ManageCityStateCountry extends Component
{
    public $country_id;
    public $state_id;
    public $city_id;
    public $countries;
    public $states;

    public function mount()
    {
        $this->countries = Country::all();
    }

    public function render()
    {

        $cities = City::where('country_id', $this->country_id)->get();
        $this->states = State::where('country_id', $this->country_id)->get();

        return view('livewire.codebooks.manage-city-state-country', [
            'countries' => $this->countries,
            'states'    => $this->states,
            'cities'    => $cities,
        ]);
    }

    public function save()
    {
        State::where('id', $this->state_id)->update(['country_id' => $this->country_id]);
        $state = State::where('id', $this->state_id)->first();

        City::where('id', $this->city_id)->update([
            'state_id'   => $this->state_id,
            'state_code' => $state->fips_code
        ]);
    }
}

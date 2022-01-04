<div class="flex flex-wrap w-full -mx-3 mb-6">
    <div class="md:w-1/3 px-3">
        <label for="country_id" class="label">Country2</label>
        <select class="select" required name="country_id" id="country_id" wire:model="selectedCountry" wire:change.prevent="changeCountry">
            <option value="">Choose Country</option>
            @foreach ($countries as $country)
                <option value="{{ $country->id }}">{{ $country->name }}</option>
            @endforeach
        </select>
    </div>

    @if(!is_null($selectedCountry))
        <div class="md:w-1/3 px-3">
            <label for="state_id" class="label">State</label>
            <select class="select" name="state_id" id="state_id" wire:model="selectedState" wire:change.prevent="changeState">
                <option value="" selected>Choose State</option>
                @foreach ($states as $state)
                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                @endforeach
            </select>
        </div>
    @endif

    @if(!is_null($selectedState))
        <div class="md:w-1/3 px-3">
            <label for="city_id" class="label">City</label>
            <select class="select" name="city_id" id="city_id" wire:model="selectedCity" wire:change.prevent="changeCity">
                <option value="" selected>Choose City</option>
                @foreach ($cities as $city)
                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                @endforeach
            </select>
        </div>
    @endif
</div>

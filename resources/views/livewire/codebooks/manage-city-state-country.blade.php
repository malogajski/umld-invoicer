<div class="m-4 p-4 max-w-sm rounded overflow-hidden shadow-sm">
    <form wire:submit.prevent="save" class="w-full">
        <div class="mb-3 xl:w-96">
            <label for="country_id" class="block text-sm font-medium text-gray-700">Country</label>
            <select name="country_id" id="country_id" wire:model="country_id">
                <option value=""></option>
                @foreach($countries as $country)
                    <option value="{{$country->id}}">{{$country->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3 xl:w-96">
            <label for="city_id" class="block text-sm font-medium text-gray-700">City</label>
            <select name="city_id" id="city_id" wire:model="city_id">
                <option value=""></option>
                @foreach($cities as $city)
                    <option value="{{$city->id}}">{{$city->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3 xl:w-96">
            <label for="state_id" class="block text-sm font-medium text-gray-700">State</label>
            <select name="state_id" id="state_id" wire:model="state_id">
                <option value=""></option>
                @foreach($states as $state)
                    <option value="{{$state->id}}">{{$state->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="ml-auto">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                    type="submit">Save Changes
            </button>
            <button class="bg-gray-500 text-white font-bold py-2 px-4 rounded"
                    wire:click="close"
                    type="button"
                    data-dismiss="modal">Close
            </button>
        </div>
    </form>
</div>

<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Associates</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <a href="{{ route('associates.create') }}" class="btn btn-primary">Add new customer</a>

                        <br/><br/>


                        <table class="table min-w-full mb-4">
                            <thead>
                            <tr>
                                <th wire:click="sortByColumn('id')" class="px-4 py-3 border-b-2 border-gray-300 text-left text-sm ">
                                    #
                                    @if ($sortColumn == 'id')
                                        <i class="fa fa-fw fa-sort-{{ $sortDirection }}"></i>
                                    @else
                                        <i class="fa fa-fw fa-sort" style="color:#DCDCDC"></i>
                                    @endif
                                </th>
                                <th wire:click="sortByColumn('name')" class="px-4 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider">
                                    Name
                                    @if ($sortColumn == 'name')
                                        <i class="fa fa-fw fa-sort-{{ $sortDirection }}"></i>
                                    @else
                                        <i class="fa fa-fw fa-sort" style="color:#DCDCDC"></i>
                                    @endif
                                </th>
                                <th wire:click="sortByColumn('address')" class="px-4 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider">
                                    Address
                                    @if ($sortColumn == 'address')
                                        <i class="fa fa-fw fa-sort-{{ $sortDirection }}"></i>
                                    @else
                                        <i class="fa fa-fw fa-sort" style="color:#DCDCDC"></i>
                                    @endif
                                </th>
                                <th wire:click="sortByColumn('city.postcode')" class="px-4 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider">
                                    Postcode
                                    @if ($sortColumn == 'city.postcode')
                                        <i class="fa fa-fw fa-sort-{{ $sortDirection }}"></i>
                                    @else
                                        <i class="fa fa-fw fa-sort" style="color:#DCDCDC"></i>
                                    @endif
                                </th>
                                <th wire:click="sortByColumn('city.name')" class="px-4 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider">
                                    City
                                    @if ($sortColumn == 'city.name')
                                        <i class="fa fa-fw fa-sort-{{ $sortDirection }}"></i>
                                    @else
                                        <i class="fa fa-fw fa-sort" style="color:#DCDCDC"></i>
                                    @endif
                                </th>
                                <th wire:click="sortByColumn('state.name')" class="px-4 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider">
                                    State
                                    @if ($sortColumn == 'state.name')
                                        <i class="fa fa-fw fa-sort-{{ $sortDirection }}"></i>
                                    @else
                                        <i class="fa fa-fw fa-sort" style="color:#DCDCDC"></i>
                                    @endif
                                </th>
                                <th wire:click="sortByColumn('country.name')" class="px-4 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider">
                                    Country
                                    @if ($sortColumn == 'country.name')
                                        <i class="fa fa-fw fa-sort-{{ $sortDirection }}"></i>
                                    @else
                                        <i class="fa fa-fw fa-sort" style="color:#DCDCDC"></i>
                                    @endif
                                </th>
                                <th wire:click="sortByColumn('phone')" class="px-4 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider">
                                    Phone
                                    @if ($sortColumn == 'phone')
                                        <i class="fa fa-fw fa-sort-{{ $sortDirection }}"></i>
                                    @else
                                        <i class="fa fa-fw fa-sort" style="color:#DCDCDC"></i>
                                    @endif
                                </th>
                                <th wire:click="sortByColumn('email')" class="px-4 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider">
                                    Email
                                    @if ($sortColumn == 'email')
                                        <i class="fa fa-fw fa-sort-{{ $sortDirection }}"></i>
                                    @else
                                        <i class="fa fa-fw fa-sort" style="color:#DCDCDC"></i>
                                    @endif
                                </th>

                                <th></th>
                            </tr>
                            <tr>
                                <td class="px-4 py-4 whitespace-no-wrap border-b border-gray-500 text-sm leading-5">
                                    <input wire:model="searchColumns.id" type="number" placeholder="Search..."
                                           class="mt-2 text-sm sm:text-base pl-2 pr-2 rounded-lg border border-gray-400 w-20 py-0.5 focus:outline-none focus:border-blue-400"/>
                                </td>
                                <td class="px-4 py-4 whitespace-no-wrap border-b border-gray-500 text-sm leading-5">
                                    <input wire:model="searchColumns.name" type="text" placeholder="Search..."
                                           class="mt-2 text-sm sm:text-base pl-2 pr-4 rounded-lg border border-gray-400 w-full py-1 focus:outline-none focus:border-blue-400"/>
                                </td>
                                <td class="px-4 py-4 whitespace-no-wrap border-b border-gray-500 text-sm leading-5">
                                    <input wire:model="searchColumns.address" type="text" placeholder="Search..."
                                           class="mt-2 text-sm sm:text-base pl-2 pr-4 rounded-lg border border-gray-400 w-full py-1 focus:outline-none focus:border-blue-400"/>
                                </td>
                                <td class="px-4 py-4 whitespace-no-wrap border-b border-gray-500 text-sm leading-5">
                                    <input wire:model="searchColumns.city.postcode" type="text" placeholder="Search..."
                                           class="mt-2 text-sm sm:text-base pl-2 pr-4 rounded-lg border border-gray-400 w-full py-1 focus:outline-none focus:border-blue-400"/>
                                </td>
                                <td class="px-4 py-4 whitespace-no-wrap border-b border-gray-500 text-sm leading-5">
                                    <select wire:model="searchColumns.city_id"
                                            class="mt-2 text-sm sm:text-base pl-2 pr-4 rounded-lg border border-gray-400 w-full py-1 focus:outline-none focus:border-blue-400">
                                        <option value="">-- choose city --</option>
                                        @foreach($cities as $city)
                                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="px-4 py-4 whitespace-no-wrap border-b border-gray-500 text-sm leading-5">
                                    <select wire:model="searchColumns.state_id"
                                            class="mt-2 text-sm sm:text-base pl-2 pr-4 rounded-lg border border-gray-400 w-full py-1 focus:outline-none focus:border-blue-400">
                                        <option value="">-- choose state --</option>
                                        @foreach($states as $state)
                                            <option value="{{ $state->id }}">{{ $state->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="px-4 py-4 whitespace-no-wrap border-b border-gray-500 text-sm leading-5">
                                    <select wire:model="searchColumns.country_id"
                                            class="mt-2 text-sm sm:text-base pl-2 pr-4 rounded-lg border border-gray-400 w-full py-1 focus:outline-none focus:border-blue-400">
                                        <option value="">-- choose country --</option>
                                        @foreach($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="px-4 py-4 whitespace-no-wrap border-b border-gray-500 text-sm leading-5">
                                    <input wire:model="searchColumns.phone" type="text" placeholder="Search..."
                                           class="mt-2 text-sm sm:text-base pl-2 pr-4 rounded-lg border border-gray-400 w-full py-1 focus:outline-none focus:border-blue-400"/>
                                </td>
                                <td class="px-4 py-4 whitespace-no-wrap border-b border-gray-500 text-sm leading-5">
                                    <input wire:model="searchColumns.email" type="text" placeholder="Search..."
                                           class="mt-2 text-sm sm:text-base pl-2 pr-4 rounded-lg border border-gray-400 w-full py-1 focus:outline-none focus:border-blue-400"/>
                                </td>


                                <td class="px-4 py-4 whitespace-no-wrap border-b border-gray-500 text-sm leading-5"></td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($associates as $associate)
                                <tr>
                                    <td class="px-4 py-4 whitespace-no-wrap border-b border-gray-500 text-sm leading-2">{{ $associate->id }}</td>
                                    <td class="px-4 py-4 whitespace-no-wrap border-b border-gray-500 text-sm leading-5">{{ $associate->name }}</td>
                                    <td class="px-4 py-4 whitespace-no-wrap border-b border-gray-500 text-sm leading-5">{{ $associate->address }}</td>
                                    <td class="px-4 py-4 whitespace-no-wrap border-b border-gray-500 text-sm leading-5">{{ $associate->city->postcode }}</td>
                                    <td class="px-4 py-4 whitespace-no-wrap border-b border-gray-500 text-sm leading-5">{{ $associate->city->name }}</td>
                                    <td class="px-4 py-4 whitespace-no-wrap border-b border-gray-500 text-sm leading-5">{{ $associate->state->name }}</td>
                                    <td class="px-4 py-4 whitespace-no-wrap border-b border-gray-500 text-sm leading-5">{{ $associate->country->name }}</td>

                                    <td class="px-4 py-4 whitespace-no-wrap border-b border-gray-500 text-sm leading-5">{{ $associate->phone }}</td>
                                    <td class="px-4 py-4 whitespace-no-wrap border-b border-gray-500 text-sm leading-5">{{ $associate->email }}</td>
                                    <td class="px-4 py-4 whitespace-no-wrap border-b border-gray-500 text-sm leading-5">
                                        <a href="#" wire:click.prevent="edit({{ $associate->id }})"><i class="far fa-edit"></i></a>
                                        <a href="#" wire:click.prevent="delete({{ $associate->id }})"
                                           onclick="confirm('Are you sure?') || event.stopImmediatePropagation()">
                                            <i class="far fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-center">
                            {{ $associates->links() }}
                        </div>

                        {{--modal--}}
                        <div
                            class="@if (!$showModal) hidden @endif flex items-center justify-center fixed left-0 bottom-0 w-full h-full bg-gray-800 bg-opacity-90">
                            <div class="bg-white rounded-lg w-1/2">
                                <form wire:submit.prevent="save" class="w-full">
                                    <div class="flex flex-col items-start p-4">
                                        <div class="flex items-center w-full border-b pb-4">
                                            <div class="text-gray-900 font-medium text-lg">{{ $associateId ? 'Edit Customer' : 'Add New Customer' }}</div>
                                            <svg wire:click="close"
                                                 class="ml-auto fill-current text-gray-700 w-6 h-6 cursor-pointer"
                                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18">
                                                <path
                                                    d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"/>
                                            </svg>
                                        </div>


                                        <div class="flex flex-wrap -mx-3 mb-6">
                                            <div class="md:w-1/2 px-3 mb-6 md:mb-0">
                                                <label class="label" for="type">
                                                    Type
                                                </label>
                                                <select name="type" id="type" wire:model="associate.type" class="select">
                                                    @foreach($types as $type)
                                                        <option value="{{$type}}" @if(old('type') === $type) selected @endif>{{ $type }}</option>
                                                    @endforeach
                                                </select>
                                                @error('associate.type')
                                                <div class="text-sm text-red-500 ml-1">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                            <div class="md:w-1/2 px-3">
                                                <label class="label" for="status">
                                                    Status
                                                </label>
                                                <select name="status" id="status" wire:model="associate.status" class="select">
                                                    @foreach($statuses as $status)
                                                        <option value="{{$status}}" @if(old('status') === $status) selected @endif>{{ $status }}</option>
                                                    @endforeach
                                                </select>
                                                @error('associate.type')
                                                <div class="text-sm text-red-500 ml-1">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="w-full">
                                            <label class="label" for="name">Name</label>
                                            <input wire:model.defer="associate.name" id="name"
                                                   class="input"/>
                                        </div>

                                        <div class="w-full">
                                            <label class="label" for="description">Description</label>
                                            <input wire:model.defer="associate.description" id="description"
                                                   class="input"/>
                                        </div>

                                        <div class="w-full">
                                            <label class="label" for="address">Address</label>
                                            <input wire:model.defer="associate.address" id="address"
                                                   class="input"/>
                                        </div>

                                        <div class="flex flex-wrap -mx-3 mb-6">
                                            <div class="md:w-1/3 px-3 mb-6 md:mb-0">
                                                <label class="label" for="pib">PIB</label>
                                                <input wire:model.defer="associate.pib" id="pib"
                                                       class="input"/>
                                            </div>

                                            <div class="md:w-1/3 px-3">
                                                <label class="label" for="registration_number">Registration Number</label>
                                                <input wire:model.defer="associate.registration_number" id="registration_number"
                                                       class="input"/>
                                            </div>

                                            <div class="md:w-1/3 px-3">
                                                <label class="label" for="responsible_person">Responsible person</label>
                                                <input wire:model.defer="associate.responsible_person" id="responsible_person"
                                                       class="input"/>
                                            </div>
                                        </div>


                                        <div class="flex flex-wrap w-full -mx-3 mb-6">
                                            <div class="md:w-1/4 px-3 mb-6 md:mb-0">
                                                <label class="label" for="phone">Phone</label>
                                                <input wire:model.defer="associate.phone" id="phone"
                                                       class="input"/>
                                            </div>

                                            <div class="md:w-1/4 px-3">
                                                <label class="label" for="mobile">Mobile</label>
                                                <input wire:model.defer="associate.mobile" id="mobile"
                                                       class="input"/>
                                            </div>

                                            <div class="md:w-1/2 px-3">
                                                <label class="label" for="email">Email</label>
                                                <input wire:model.defer="associate.email" id="address" type="email"
                                                       class="input"/>
                                            </div>
                                        </div>

                                        @if($selectedCity)
                                            @livewire('components.country-state-city-component', [$selectedCity]) @endif


                                        <div class="ml-auto">
                                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                                                    type="submit">{{ $associateId ? 'Save Changes' : 'Save' }}
                                            </button>
                                            <button class="bg-gray-500 text-white font-bold py-2 px-4 rounded"
                                                    wire:click="close"
                                                    type="button"
                                                    data-dismiss="modal">Close
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

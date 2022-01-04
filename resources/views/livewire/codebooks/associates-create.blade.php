<div>
    @extends('layouts.app')

    @section('content')
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Add new customer</div>

                        @include('comon.flash-messages')

                        <div class="card-body">
                            <form action="{{ route('associates.store') }}" method="POST">
                                @csrf

                                <div class="card-deck">
                                    <div>
                                        <label for="name" class="block text-sm ml-8">Type</label>
                                        <div class="mt-1 ml-8">
                                            <select name="type" id="type">
                                                @foreach($types as $type)
                                                    <option value="{{$type}}" @if(old('type') === $type) selected @endif>{{ $type }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div>
                                        <label for="status" class="block text-sm ml-8">Status</label>
                                        <div class="mt-1 ml-8">
                                            <select name="status" id="status">
                                                @foreach($statuses as $status)
                                                    <option value="{{$status}}" @if(old('status') === $status) selected @endif>{{ $status }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-4">
                                    <label for="name">Title</label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{old('name' ?? $name)}}" required/>
                                </div>

                                <div class="col-md-4">
                                    <label for="description">Second name or description</label>
                                    <input type="text" name="description" id="description" value="{{old('description' ?? $description)}}" class="form-control" required/>
                                </div>

                                <div class="col-md-4">
                                    <label for="address">Address</label>
                                    <input type="text" name="address" id="address" class="form-control" value="{{old('address' ?? $address)}}" required/>
                                </div>

                                <div class="col-md-4">
                                    <label for="pib">PIB</label>
                                    <input type="text" name="pib" id="pib" class="form-control" value="{{old('pib' ?? $pib)}}" required/>
                                </div>

                                <div class="col-md-4">
                                    <label for="registration_number">Register No.</label>
                                    <input type="text" name="registration_number" id="registration_number" value="{{old('registration_number' ?? $registration_number)}}" class="form-control" required/>
                                </div>

                                <div class="col-md-4">
                                    <label for="responsible_person">Responsible person</label>
                                    <input type="text" name="responsible_person" id="responsible_person" value="{{old('responsible_person' ?? $responsible_person)}}" class="form-control" required>
                                </div>

                                <div class="col-md-4">
                                    <label for="phone">Phone</label>
                                    <input type="text" id="phone" name='phone' value="{{old('phone' ?? $phone)}}" class="form-control"/>
                                </div>

                                <div class="col-md-4">
                                    <label for="mobile">Mobile</label>
                                    <input type="text" id="mobile" name="mobile" value="{{old('mobile' ?? $mobile)}}" class="form-control" required/>
                                </div>

                                <div class="col-md-4">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" name='email' value="{{old('email' ?? $email)}}" class="form-control"/>
                                </div>

                                @livewire('components.country-state-city-component')

                                <div class="mt-4 ml-2">
                                    <input type="submit" value="Save customer" class="btn btn-primary"/>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
</div>

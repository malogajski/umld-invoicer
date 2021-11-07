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
                                <div class="col-md-4">
                                    <label for="name">Type</label>
                                    <select name="type" id="type"  class="form-control">
                                        @foreach($types as $type)
                                            <option value="{{$type}}">{{ $type }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        @foreach($statuses as $status)
                                            <option value="{{$status}}">{{ $status }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="name">Title</label>
                                <input type="text" name='name' id="name" class="form-control" required/>
                            </div>

                            <div class="col-md-4">
                                <label for="description">Second name or description</label>
                                <input type="text" name="description" id="description" class="form-control" required/>
                            </div>

                            <div class="col-md-4">
                                <label for="address">Address</label>
                                <input type="text" name="address" id="address" class="form-control" required/>
                            </div>

                            <div class="col-md-4">
                                <label for="pib">PIB</label>
                                <input type="text" name="pib" id="pib" class="form-control" required/>
                            </div>

                            <div class="col-md-4">
                                <label for="registration_number">Register No.</label>
                                <input type="text" name="registration_number" id="registration_number" class="form-control" required/>
                            </div>

                            <div class="col-md-4">
                                <label for="responsible_person">Responsible person</label>
                                <input type="text" name="responsible_person" id="responsible_person" class="form-control" required>
                            </div>

                            <div class="col-md-4">
                                <label for="phone">Phone</label>
                                <input type="text" id="phone" name='phone' class="form-control"/>
                            </div>

                            <div class="col-md-4">
                                <label for="mobile">Mobile</label>
                                <input type="text" id="mobile" name="mobile" class="form-control" required/>
                            </div>

                            <div class="col-md-4">
                                <label for="email">Email</label>
                                <input type="email" id="email" name='email' class="form-control"/>
                            </div>

                            <div class="card-deck m-sm-1">
                                <div class="col-md-4">
                                    <label for="country_id">Country</label>
                                    <select class="form-control" required name="country_id" id="country_id">
                                        <option value="">Choose Country</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="state_id">State</label>
                                    <select class="form-control" name="state_id" id="state_id">
                                        <option value="" selected>Choose State</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="city_id">City</label>
                                    <select class="form-control" name="city_id" id="city_id">
                                        <option value="" selected>Choose City</option>
                                    </select>
                                </div>
                            </div>

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

@section('scripts')
    {{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            // Country change - set state
            $('#country_id').change(function () {
                console.log('country_id: ' + $(this).val())
                let $state = $('#state_id');
                $.ajax({
                    url: "{{ route('states.index') }}",
                    data: {
                        country_id: $(this).val()
                    },
                    success: function (data) {
                        $state.html('<option value="" selected>Choose state</option>');
                        $.each(data, function (id, value) {
                            console.log(data);
                            console.log('id: ' + id);
                            console.log('value' + value);
                            $state.append('<option value="' + id + '">' + value + '</option>');
                        });
                    }
                });

                $('#state_id, #city_id').val("");
                $('#state').removeClass('d-none');
            });

            // State change - set city
            $('#state_id').change(function () {
                let $city = $('#city_id');
                console.log('state_id: ' + $(this).val())
                $.ajax({
                    url: "{{ route('cities.index') }}",
                    data: {
                        state_id: $(this).val()
                    },
                    success: function (data) {
                        $city.html('<option value="" selected>Choose city</option>');
                        $.each(data, function (id, value) {
                            $city.append('<option value="' + id + '">' + value + '</option>');
                        });
                    }
                });
                $('#city').removeClass('d-none');
            });
        });
    </script>
@endsection

@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            Card Header
        </div>
        @include('comon.flash-messages')
        <div class="card-body">
            <form action="{{ route('store.host') }}" method="POST" class="form-group">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <label for="name">{{ trans('labels.name') }}</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{old('name')}}">

                        <label for="description">{{ trans('labels.description') }}</label>
                        <input type="text" class="form-control" name="description" id="description" value="{{old('description')}}">

                        <label for="tax_id">{{ trans('labels.tax_id') }}</label>
                        <input type="text" class="form-control" name="tax_id" id="tax_id" value="{{old('tax_id')}}">

                        <label for="bank_account">{{ trans('labels.bank_account') }}</label>
                        <input type="text" class="form-control" name="bank_account" id="bank_account" value="{{old('bank_account')}}">
                    </div>

                    <div class="col-md-4">
                        <label for="number_id">{{ trans('labels.number_id') }}</label>
                        <input type="text" class="form-control" name="number_id" id="number_id" value="{{old('number_id')}}">

                        <label for="address">{{ trans('labels.address') }}</label>
                        <input type="text" class="form-control" name="address" id="address" value="{{old('address')}}">

                        <label for="city_id">{{ trans('labels.city') }}</label>
                        <select name="city_id" id="city_id" class="form-control">
                            @foreach($cities as $city)
                                <option value="{{$city->id}}">{{ $city->name }}</option>
                            @endforeach
                        </select>

                        <label for="country_id">{{ trans('labels.country') }}</label>
                        <select name="country_id" id="country_id" class="form-control">
                            @foreach($countries as $country)
                                <option value="{{$country->id}}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-4">
                        <label for="email">{{ trans('labels.email') }}</label>
                        <input type="email" class="form-control" name="email" id="email" value="{{old('email')}}">

                        <label for="web">{{ trans('labels.web') }}</label>
                        <input type="text" class="form-control" name="web" id="web" value="{{old('web')}}">

                        <label for="responsible_person">{{ trans('labels.responsible_person') }}</label>
                        <input type="text" class="form-control" name="responsible_person" id="responsible_person" value="{{old('responsible_person')}}">
                    </div>

                    <div class="col-md-4">
                        <label for="phone">{{ trans('labels.phone') }}</label>
                        <input type="text" class="form-control" name="phone" id="phone" value="{{old('phone')}}">

                        <label for="mobile">{{ trans('labels.mobile') }}</label>
                        <input type="text" class="form-control" name="mobile" id="mobile" value="{{old('mobile')}}">

                    </div>

                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="dz-message needsclick upload-file">
                            <div class="d-flex justify-content-center h-100">
                                <div class="description-icon d-flex align-items-center">
                                    <i class="fas fa-cloud-upload-alt fa-3x"></i>
                                </div>
                                <div class="description-text d-flex align-items-center ml-3 mt-3 text-left">
                                    <p>{!!html_entity_decode(trans('labels.logo_img'))!!}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">{{trans('buttons.save')}}</button>
                    {{--                    <button class="form-button form-button-active ml-2" onclick="document.getElementById('dropzone').submit();">{{trans('buttons.save')}}</button>--}}
                </div>
            </form>


        </div>
    </div>
@endsection

@section('scripts')
    <script type="application/javascript" src="{{ asset('js/dropzone.css') }}" defer></script>
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <script type="application/javascript" src="{{ asset('js/upload-image.js')}}"></script>
@endsection

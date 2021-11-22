<div class="container">
    <div class="grid grid-rows-3 grid-flow-col gap-4">
        <div class="row-span-3 bg-blue-300">

            <div class="input-div-main">
                <label for="name" class="input-label-main">Name</label>
                <input type="text" name="name" id="name" wire:model="hosts.name" value="{{old('name') ?? ''}}">
            </div>

            <div class="input-div-main">
                <label for="description" class="input-label-main">description</label>
                <input type="text" wire:model="hosts.description" value="{{old('description') ?? ''}}">
            </div>


            <div class="row input-detail-2-col-div">
                <div class="input-div-detail">
                    <label for="tax_id" class="input-label-detail">tax_id</label>
                    <input type="text" wire:model="hosts.tax_id" value="{{old('tax_id') ?? ''}}">
                </div>

                <div class="input-div-detail">
                    <label for="number_id" class="input-label-detail">number_id</label>
                    <input type="text" name="number_id" id="number_id" wire:model="hosts.number_id" value="{{old('number_id') ?? ''}}">
                </div>
            </div>

            <div class="row input-detail-2-col-div">
                <div class="input-div-detail">
                    <label for="address" class="input-label-detail">address</label>
                    <input type="text" id="address" wire:model="hosts.address" value="{{old('address') ?? ''}}">
                </div>

                <div class="input-div-detail">
                    <label for="city_id" class="input-label-detail">City</label>
                    <select name="city_id" id="city_id">
                        <option value=""></option>
                    </select>
                </div>
            </div>

            <div class="row input-detail-2-col-div">
                <div class="input-div-detail">
                    <label for="state_id" class="input-label-detail">State</label>
                    <select name="state_id" id="state_id">
                        <option value=""></option>
                    </select>
                </div>

                <div class="input-div-detail">
                    <label for="country_id" class="input-label-detail">Country</label>
                    <select name="country_id" id="country_id">
                        <option value=""></option>
                    </select>
                </div>
            </div>


        </div>
        <div class="col-span-2 bg-green-400">
            <label for="email" class="block text-sm font-medium text-gray-700">email</label>
            <div class="mt-1">
                <input type="text" wire:model="hosts.email" value="{{old('email') ?? ''}}">
            </div>

            <label for="web" class="block text-sm font-medium text-gray-700">web</label>
            <div class="mt-1">
                <input type="text" wire:model="hosts.web" value="{{old('web') ?? ''}}">
            </div>

            <label for="responsible_person" class="block text-sm font-medium text-gray-700">responsible_person</label>
            <div class="mt-1">
                <input type="text" wire:model="hosts.responsible_person" value="{{old('responsible_person') ?? ''}}">
            </div>

            <label for="phone" class="block text-sm font-medium text-gray-700">phone</label>
            <div class="mt-1">
                <input type="text" wire:model="hosts.phone" value="{{old('phone') ?? ''}}">
            </div>

            <label for="mobile" class="block text-sm font-medium text-gray-700">mobile</label>
            <div class="mt-1">
                <input type="text" wire:model="hosts.mobile" value="{{old('mobile') ?? ''}}">
            </div>

            <label for="bank_account" class="block text-sm font-medium text-gray-700">bank_account</label>
            <div class="mt-1">
                <input type="text" wire:model="hosts.bank_account" value="{{old('bank_account') ?? ''}}">
            </div>

            <label for="logo_img" class="block text-sm font-medium text-gray-700">logo_img</label>
            <div class="mt-1">
                <input type="text" wire:model="hosts.logo_img" value="{{old('logo_img') ?? ''}}">
            </div>

            <label for="default_language" class="block text-sm font-medium text-gray-700">default_language</label>
            <div class="mt-1">
                <input type="text" wire:model="hosts.default_language" value="{{old('default_language') ?? ''}}">
            </div>
        </div>
        <div class="row-span-2 col-span-2 bg-yellow-200">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                </tr>
                </thead>
                <tbody>
                @foreach($hosts as $host)
                    <tr>
                        <td>{{$host->id}}</td>
                        <td>{{$host->name}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="grid grid-rows-3 grid-flow-col gap-2 bg-yellow-200">
        <form wire:submit.prevent="saveHost()">

        </form>


    </div>

</div>

{{--<div class="card">--}}
{{--    <div class="card-header">--}}
{{--        Card Header--}}
{{--    </div>--}}
{{--    @include('comon.flash-messages')--}}
{{--    <div class="card-body">--}}
{{--        <form action="{{ route('store.host') }}" method="POST" class="form-group">--}}
{{--            @csrf--}}
{{--            <div class="row">--}}
{{--                <div class="col-md-4">--}}
{{--                    <label for="name">{{ trans('labels.name') }}</label>--}}
{{--                    <input type="text" class="form-control" name="name" id="name" value="{{old('name')}}">--}}

{{--                    <label for="description">{{ trans('labels.description') }}</label>--}}
{{--                    <input type="text" class="form-control" name="description" id="description" value="{{old('description')}}">--}}

{{--                    <label for="tax_id">{{ trans('labels.tax_id') }}</label>--}}
{{--                    <input type="text" class="form-control" name="tax_id" id="tax_id" value="{{old('tax_id')}}">--}}

{{--                    <label for="bank_account">{{ trans('labels.bank_account') }}</label>--}}
{{--                    <input type="text" class="form-control" name="bank_account" id="bank_account" value="{{old('bank_account')}}">--}}
{{--                </div>--}}

{{--                <div class="col-md-4">--}}
{{--                    <label for="number_id">{{ trans('labels.number_id') }}</label>--}}
{{--                    <input type="text" class="form-control" name="number_id" id="number_id" value="{{old('number_id')}}">--}}

{{--                    <label for="address">{{ trans('labels.address') }}</label>--}}
{{--                    <input type="text" class="form-control" name="address" id="address" value="{{old('address')}}">--}}

{{--                    <label for="city_id">{{ trans('labels.city') }}</label>--}}
{{--                    <select name="city_id" id="city_id" class="form-control">--}}
{{--                        @foreach($cities as $city)--}}
{{--                            <option value="{{$city->id}}">{{ $city->name }}</option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}

{{--                    <label for="country_id">{{ trans('labels.country') }}</label>--}}
{{--                    <select name="country_id" id="country_id" class="form-control">--}}
{{--                        @foreach($countries as $country)--}}
{{--                            <option value="{{$country->id}}">{{ $country->name }}</option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
{{--                </div>--}}

{{--            </div>--}}

{{--            <div class="row">--}}
{{--                <div class="col-md-4">--}}
{{--                    <label for="email">{{ trans('labels.email') }}</label>--}}
{{--                    <input type="email" class="form-control" name="email" id="email" value="{{old('email')}}">--}}

{{--                    <label for="web">{{ trans('labels.web') }}</label>--}}
{{--                    <input type="text" class="form-control" name="web" id="web" value="{{old('web')}}">--}}

{{--                    <label for="responsible_person">{{ trans('labels.responsible_person') }}</label>--}}
{{--                    <input type="text" class="form-control" name="responsible_person" id="responsible_person" value="{{old('responsible_person')}}">--}}
{{--                </div>--}}

{{--                <div class="col-md-4">--}}
{{--                    <label for="phone">{{ trans('labels.phone') }}</label>--}}
{{--                    <input type="text" class="form-control" name="phone" id="phone" value="{{old('phone')}}">--}}

{{--                    <label for="mobile">{{ trans('labels.mobile') }}</label>--}}
{{--                    <input type="text" class="form-control" name="mobile" id="mobile" value="{{old('mobile')}}">--}}

{{--                </div>--}}

{{--            </div>--}}

{{--            <div class="row">--}}
{{--                <div class="col-12">--}}
{{--                    <div class="dz-message needsclick upload-file">--}}
{{--                        <div class="d-flex justify-content-center h-100">--}}
{{--                            <div class="description-icon d-flex align-items-center">--}}
{{--                                <i class="fas fa-cloud-upload-alt fa-3x"></i>--}}
{{--                            </div>--}}
{{--                            <div class="description-text d-flex align-items-center ml-3 mt-3 text-left">--}}
{{--                                <p>{!!html_entity_decode(trans('labels.logo_img'))!!}</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="card-footer">--}}
{{--                <button type="submit" class="btn btn-primary">{{trans('buttons.save')}}</button>--}}
{{--                --}}{{--                    <button class="form-button form-button-active ml-2" onclick="document.getElementById('dropzone').submit();">{{trans('buttons.save')}}</button>--}}
{{--            </div>--}}
{{--        </form>--}}


{{--    </div>--}}
{{--</div>--}}




@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Invoice number {{ $invoice->number }}</div>

                <div class="card-body">
                    <div class="container">

                        {{-- Invoice header --}}
                        <div class="grid grid-rows-3 grid-flow-col gap-1">
                        {{-- Logo--}}
                            <div class="row-span-3">
                                @if (config('invoices.logo_file') != '')
                                    <div class="col-md-12 text-center">
                                        <img src="{{ config('invoices.logo_file') }}" style="width: 200px; height: auto" />
                                    </div>
                                @endif
                                <div class="row">
                                    <h2 class="text-3xl ml-8 mt-6 text-gray-500">{{$invoice->types->name}}</h2>
                                </div>
                                <div class="row top-4">
                                    <div class="float-left small ml-4 mt-5">
                                        <strong>{{$invoice->types->name}} for:</strong><br>
                                        <strong>{{ $invoice->associates->name }}</strong>
                                        <br />

                                        <b>Address</b>:
                                        {{ $invoice->associates->address }}
                                        @if ($invoice->associates->city->postcode != '')
                                            ,
                                            {{ $invoice->associates->city->postcode }}
                                        @endif
                                        , {{ $invoice->associates->city->name }}
                                        @if ($invoice->associates->country->name != '')
                                            ,
                                            {{ $invoice->associates->country->name }}
                                        @endif

                                        @if ($invoice->associates->phone != '')
                                            <br /><b>Phone</b>: {{ $invoice->associates->phone }}
                                        @endif
                                        @if ($invoice->associates->email != '')
                                            <br /><b>Email</b>: {{ $invoice->associates->email }}
                                        @endif

                                    </div>
                                </div>

                            </div>
                        {{-- Right side top header --}}
                            <div class="col-span-2">
                                <div class="float-right col-md-6 small">
                                    {{ config('invoices.seller.name') }}
                                    <br>
                                    {{ config('invoices.seller.address') }}
                                    <br>
                                    @if (is_array(config('invoices.seller.additional_info')))
                                        @foreach (config('invoices.seller.additional_info') as $key => $value)
                                            <b>{{ $key }}</b>: {{ $value }}
                                        @endforeach
                                    @endif
                                    {{ config('invoices.seller.bank_account') }}
                                    @if (config('invoices.seller.email') != '')
                                        <br>
                                        {{ config('invoices.seller.email') }}
                                    @endif
                                </div>
                            </div>
                        {{-- Right side bottom header --}}
                            <div class="row-span-2 col-span-2">
                                <div class="col-md-6 small top-1/2 float-right">
                                    <strong>{{ $invoice->types->name }} &nbsp;# {{ $invoice->number }}</strong>
                                    <br />
                                    Date: {{ $invoice->date }}<br>
                                    Due date: {{ $invoice->due_date }}<br>
                                    Payment type: via Bank <br>
                                    Delivery place: {{$invoice->associates->address }}
                                </div>
                            </div>

                        </div>

                        <div class="row clearfix" style="margin-top:20px">
                            <div class="col-md-12">
                                <table class="table table-bordered table-hover text-sm" id="tab_logic">
                                    <thead>
                                    <tr>
                                        <th class="text-center"> # </th>
                                        <th class="text-center"> Product </th>
                                        <th class="text-center"> Qty </th>
                                        <th class="text-center"> Price ({{ config('invoices.currency') }}) </th>
                                        <th class="text-center"> Tax (%) </th>
                                        <th class="text-center"> Sub total ({{ config('invoices.currency') }}) </th>
                                        <th class="text-center"> Tax ({{ config('invoices.currency') }}) </th>
                                        <th class="text-center"> Total ({{ config('invoices.currency') }}) </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($invoice->details as $key => $item)
                                    <tr id='addr0'>
{{--                                        @dd($item)--}}
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-left">{{ $item->products->name }}</td>
                                        <td class="text-center">{{ $item->quantity }}</td>
                                        <td class="text-center">{{ $item->price }}</td>
                                        <td class="text-center">{{ $item->tax }}</td>
                                        <td class="text-center">{{ number_format($item->total_without_tax, 2) }}</td>
                                        <td class="text-center">{{ number_format($item->total_tax, 2) }}</td>
                                        <td class="text-center">{{ number_format($item->total, 2) }}</td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row clearfix" style="margin-top:20px">
                            <div class="col-md-12">
                                <div class="float-right col-md-5">
                                    <table class="table table-bordered table-hover text-sm" id="tab_logic_total">
                                        <tbody>
                                        <tr>
                                            <th class="text-left" width="60%">Sub Total ({{ config('invoices.currency') }})</th>
                                            <td class="text-right">{{ number_format($invoice->sub_total, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-left">Tax Amount ({{ config('invoices.currency') }})</th>
                                            <td class="text-right">{{ number_format($invoice->tax_total, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-left">Grand Total ({{ config('invoices.currency') }})</th>
                                            <td class="text-right">{{ number_format($invoice->total, 2) }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix" style="margin-top:20px">
                            <div class="col-md-12">
                                {{ config('invoices.footer_text') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


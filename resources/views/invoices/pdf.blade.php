@extends('layouts.pdf')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Invoice number {{ $invoice->number }}</div>

                    <div class="card-body">
                        <div class="container">

                            <div class="fow clearfix offset-6 pb-2">
                                @if (config('invoices.logo_file') != '')
                                    <div class="col-md-12 text-center">
                                        <img src="{{ config('invoices.logo_file') }}" style="width: 200px; height: auto" />
                                    </div>
                                @endif


                                <div class="col-md-12 offset-2 text-left small pt-2">
                                    <strong>Invoice {{ $invoice->number }}</strong>
                                    <br />
                                    Date: {{ $invoice->date }}<br>
                                    Due date: {{ $invoice->due_date }}
                                </div>
                            </div>

                            <div class="row clearfix" style="margin-top:20px">
                                <div class="col-md-12">
                                    <div class="float-left col-md-6 small">
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
                                            <br /><br /><b>Phone</b>: {{ $invoice->associates->phone }}
                                        @endif
                                        @if ($invoice->associates->email != '')
                                            <br /><br /><b>Email</b>: {{ $invoice->associates->email }}
                                        @endif

                                        {{--                                    @if ($invoice->customer->customer_fields)--}}
                                        {{--                                        @foreach ($invoice->customer->customer_fields as $field)--}}
                                        {{--                                            <br /><br /><b>{{ $field->field_key }}</b>: {{ $field->field_value }}--}}
                                        {{--                                        @endforeach--}}
                                        {{--                                    @endif--}}
                                    </div>
                                    <div class="float-right col-md-5 small">
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
                            </div>

                            <div class="row clearfix" style="margin-top:20px">
                                <div class="col-md-12">
                                    <table class="table table-bordered table-hover" id="tab_logic">
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
                                        @foreach ($invoice->invoice_items as $key => $item)
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
                                        <table class="table table-bordered table-hover" id="tab_logic_total">
                                            <tbody>
                                            <tr>
                                                <th class="text-left" width="60%">Sub Total ({{ config('invoices.currency') }})</th>
                                                <td class="text-right">{{ number_format($invoice->invoice_sub_total, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-left">Tax Amount ({{ config('invoices.currency') }})</th>
                                                <td class="text-right">{{ number_format($invoice->tax_amount, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <th class="text-left">Grand Total ({{ config('invoices.currency') }})</th>
                                                <td class="text-right">{{ number_format($invoice->total_amount, 2) }}</td>
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

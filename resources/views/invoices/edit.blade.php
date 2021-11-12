@extends('layouts.app')

@section('content')
    <div class="container">
        @livewire('invoices.invoice-create', ['invoice' => $invoice])
    </div>
@endsection

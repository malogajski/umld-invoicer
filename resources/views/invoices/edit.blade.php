@extends('layouts.app')

@section('content')
    <div class="container">
        @livewire('invoice-create', ['invoice' => $invoice])
    </div>
@endsection

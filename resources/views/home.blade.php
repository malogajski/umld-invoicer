@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            Hello, {{auth()->user()->name}}
        </div>
    </div>
@endsection

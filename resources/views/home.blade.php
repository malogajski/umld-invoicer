@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @if(isset(auth()->user()->name))
                Hello, {{auth()->user()->name}}
            @else
                <script>window.location = "/login";</script>
            @endif
        </div>
    </div>
@endsection

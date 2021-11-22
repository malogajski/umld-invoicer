@extends('layouts.app')

@section('content')
    @livewire('admin.host')
@endsection

@section('scripts')
    <script type="application/javascript" src="{{ asset('js/dropzone.css') }}" defer></script>
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <script type="application/javascript" src="{{ asset('js/upload-image.js')}}"></script>
@endsection

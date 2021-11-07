@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">
            Create or Edit User
        </div>

        <div class="card-body col-md-4">
            @include('comon.flash-messages')

            <form method="POST" action="@if($user->id) {{route('update.user', $user->id)}} @endif" class="form-group">
                @csrf
                <label for="name">Name</label>
                <input class="form-control" id="name" name="name" type="text" value="{{old($user->name) ? old($user->name) : $user->name}}">
                <div class="errormessage">{{ $errors->first('name') }}</div>

                <label>Email</label>
                <input id="email" name="email" class="form-control" type="text" value="{{old($user->email) ? old($user->email) : $user->email}}">
                <div class="errormessage">{{ $errors->first('email') }}</div>

                <label for="host_id">Host</label>
                <select class="form-control" name="host_id" id="host_id">
                    <option value=""></option>
                    @foreach($hosts as $host)
                        <option value="{{$host->id}}" @if($host->id == $user->host_id) selected @endif>{{ $host->name }}</option>
                    @endforeach
                </select>
                <div class="errormessage">{{ $errors->first('host_id') }}</div>
                <br>
                <button class="btn btn-primary">Save</button>
            </form>

        </div>
    </div>

@endsection

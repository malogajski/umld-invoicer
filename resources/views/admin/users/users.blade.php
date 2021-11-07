@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Host</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->host->name }}</td>
                        <td>
                            <span class="m-2"><a href="{{ route('edit.user', $user->id) }}"><i class="far fa-edit"></i></a></span>
                            <span class="m-2"><a href="{{ route('delete.user', $user->id) }}"><i class="far fa-trash-alt"></i></a></span>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

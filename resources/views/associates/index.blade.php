@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Associates</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="{{ route('associates.create') }}" class="btn btn-primary">Add new customer</a>

                    <br /><br />

                    <table class="table">
                        <tr>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Postcode</th>
                            <th>City</th>
{{--                            <th>State</th>--}}
                            <th>Country</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th></th>
                        </tr>
                        @foreach ($associates as $customer)

                            <tr>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->address }}</td>
                                <td>{{ $customer->city->postcode }}</td>
                                <td>{{ $customer->city->name }}</td>
{{--                                <td>{{ $customer->state }}</td>--}}
                                <td>{{ $customer->country->name }}</td>
                                <td>{{ $customer->phone }}</td>
                                <td>{{ $customer->email }}</td>
                                <td><a href="{{ route('invoices.create') }}?associate_id={{ $customer->id }}" class="btn btn-xs btn-primary">New Invoice</a></td>
                            </tr>
                        @endforeach
                    </table>
                        <div class="d-flex justify-content-center">
                            {{ $associates->links() }}
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

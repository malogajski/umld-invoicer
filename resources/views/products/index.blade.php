@extends('layouts.app')

@section('content')
<div class="container">
{{--    @livewire('product-create')--}}
    @livewire('codebooks.products', [$products])
</div>

{{--<div class="container">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-12">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">Products</div>--}}

{{--                @include('comon.flash-messages')--}}

{{--                <div class="card-body">--}}
{{--                    @if (session('status'))--}}
{{--                        <div class="alert alert-success" role="alert">--}}
{{--                            {{ session('status') }}--}}
{{--                        </div>--}}
{{--                    @endif--}}

{{--                    <a href="{{ route('products.create') }}" class="btn btn-primary">Add new product</a>--}}

{{--                    <br /><br />--}}

{{--                    <table class="table">--}}
{{--                        <tr>--}}
{{--                            <th>#</th>--}}
{{--                            <th>Name</th>--}}
{{--                            <th>Brand</th>--}}
{{--                            <th>Description</th>--}}
{{--                            <th>SKU</th>--}}
{{--                            <th>Barcode</th>--}}
{{--                            <th>Tax</th>--}}
{{--                            <th>Price</th>--}}
{{--                            <th></th>--}}
{{--                        </tr>--}}
{{--                        @forelse ($products as $product)--}}
{{--                            <tr>--}}
{{--                                <td>{{ $product->id }}</td>--}}
{{--                                <td>{{ $product->name }}</td>--}}
{{--                                <td>{{ $product->brand }}</td>--}}
{{--                                <td>{{ $product->description }}</td>--}}
{{--                                <td>{{ $product->sku }}</td>--}}
{{--                                <td>{{ $product->barcode }}</td>--}}
{{--                                <td>{{ $product->tax }}</td>--}}
{{--                                <td>{{ $product->price }}</td>--}}
{{--                                <td><a href="{{ route('products.edit', $product->id) }}"><i class="far fa-edit"></i></a></td>--}}
{{--                            </tr>--}}
{{--                        @empty--}}
{{--                            <tr>--}}
{{--                                <td colspan="2">No products found.</td>--}}
{{--                            </tr>--}}
{{--                        @endforelse--}}
{{--                    </table>--}}
{{--                        <div class="d-flex justify-content-center pagination">--}}
{{--                            {{ $products->links() }}--}}
{{--                        </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
@endsection

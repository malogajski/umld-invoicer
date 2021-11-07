@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Add new product</div>

                    @include('comon.flash-messages')

                    <div class="card-body">
                        <form action="{{ route('products.store') }}" method="POST">
                            @csrf
                            <label for="name">Name</label>
                            <input type="text" name='name' class="form-control" required />

                            <label for="description">Description</label>
                            <input type="text" name='description' class="form-control" />

                            <label for="sku">SKU</label>
                            <input type="text" name="sku" class="form-control" />

                            <label for="barcode">Barcode</label>
                            <input type="text" name="barcode" class="form-control"  />

                            <label for="price">Price</label>
                            <input type="number" name="price" class="form-control" required />

                            <label for="unit">Unit</label>
                            <input type="text" name="unit" id="unit" class="form-control">

                            <label for="tax">Tax</label>
                            <input type="number" name="tax" class="form-control" required />

                            <br />
                            <input type="submit" value="Save product" class="btn btn-primary" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<div class="container">
    <div class="card">

        <form wire:submit.prevent="saveInvoice">

            <div class="card-header">
                <div class="row">

                    {{-- Left Side Master --}}
                    <div class="col-md-5">
                        <div class="col-xs-2">
                            <label for="number">Invoice No.</label>
                            <input type="text" name="number" id="number" wire:model="number" class="form-control">

                            <label for="date">Creation Date</label>
                            <input type="date" name="date" id="date" wire:model="date" class="form-control">

                            <label for="due_date">Due Date</label>
                            <input type="date" name="due_date" id="due_date" wire:model="due_date" class="form-control">
                        </div>
                    </div>

                    {{-- Right Side Master --}}
                    <div class="col-md-5">

                        <label for="associate_id">Customer name</label>
                        <select name="associate_id"
                                class="form-control"
                                wire:model="associate_id">
                            <option value="">-- choose customer --</option>
                            @foreach ($associates as $associate)

                                <option value="{{ $associate->id }}"  selected >
                                    {{ $associate->name }}
                                </option>
                            @endforeach
                        </select>

                        <label for="type">Invoice type</label>
                        <select name="type"
                                class="form-control"
                                wire:model="type">
                            <option value="">-- choose type --</option>
                            @foreach ($types as $item)
                                <option value="{{ $item->id }}">
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>

                    </div>

                </div>
            </div>
            <div class="card-body">
                {{--        SEARCH BOX - TODO: Include this from component --}}
                <div class="col-md-8 align-content-center">
                    <label for="search">Search</label>
                    <input type="text" wire:model="searchProduct" name="search" id="search" class="form-control" autocomplete="off">
                    <ul class="list-group">
                        @foreach($products as $product)
                            <li wire:click="selectedProduct({{$product->id}})" wire:model="results" class="list-group-item list-group-item-action shadow">
                                {{ $product->name }} ( {{ $product->price }})
                            </li>

                        @endforeach
                    </ul>
                </div>
                {{-- END SEARCH --}}

                {{--        ITEMS           --}}
                <br>
                <table class="table table-striped table-responsive-md">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Tax</th>
                        <th>Sub total</th>
                        <th>Tax total</th>
                        <th class="text-right">TOTAL</th>
                        <th></th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($list as $index => $item)
                        <tr>
                            <td>{{ $invoice->details ? $item['products']['id'] : $item['product_id']}}</td>
                            <td>{{ $invoice->details ? $item['products']['name'] : $item['name'] ?? ''}}</td>
                            <td>{{ $invoice->details ? $item['products']['price'] : $item['price']}}</td>

                            <td>
                                <input type="number" placeholder="0.00"   name="list[{{$index}}][quantity]"
                                       class="form-control col-4" wire:model="list.{{$index}}.quantity"/>
                            </td>

                            <td>{{$item['tax']}}</td>

                            @php
                                $item_sub_total = $item['price'] * ($item['quantity'] ?? 1);
                                $item_tax_total = $item_sub_total * ($item['tax']/100.00);
                                $item_total = $item_sub_total + $item_tax_total;
                                $list[$index]['sub_total'] = $item_sub_total;
                                $list[$index]['tax_total'] = $item_tax_total;
                            @endphp

                            <input type="hidden" name="list[{{$index}}][sub_total]"
                                   wire:model="list.{{$index}}.sub_total"/>

                            <td class="text-right" wire:model="sub_total">{{$list[$index]['sub_total']}}</td>
                            <td class="text-right" wire:model="tax_total">{{$list[$index]['tax_total']}}</td>

                            <td class="text-right">{{$item_total}}</td>

                            <td>
                                <button class="btn btn-sm btn-danger"
                                        wire:click.prevent="removeProduct({{$index}})">Delete
                                </button>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="7" class="text-right">SUB TOTAL:</td>
                        <td class="text-right">{{$sub_total}}</td>
                    </tr>
                    <tr>
                        <td colspan="7" class="text-right">TAX TOTAL:</td>
                        <td class="text-right">{{$tax_total}}</td>
                    </tr>
                    <tr>
                        <td colspan="7" class="text-right">TOTAL:</td>
                        <td class="text-right">{{$total}}</td>
                    </tr>
                    </tfoot>
                </table>
                <div>

                </div>
            </div>
            <div class="card-footer">
                <input class="btn btn-primary" type="submit" value="Save Invoice">
            </div>
        </form>

    </div>




    {{--<div>--}}
    {{--    <livewire:components.search-product />--}}

    {{--    @if ($invoiceSaved)--}}
    {{--        <div class="alert alert-info">Invoice saved successfully.</div>--}}
    {{--    @endif--}}
    {{--    <form wire:submit.prevent="saveInvoice">--}}
    {{--        @csrf--}}
    {{--        <div class="form-group {{ $errors->has('customer_name') ? 'has-error' : '' }}">--}}

    {{--            <label for="associate_id">Customer name</label>--}}
    {{--            <select name="associate_id"--}}
    {{--                    class="form-control"--}}
    {{--                    wire:model="associate_id">--}}
    {{--                <option value="">-- choose customer --</option>--}}
    {{--                @foreach ($associates as $associate)--}}
    {{--                    <option value="{{ $associate->id }}">--}}
    {{--                        {{ $associate->name }}--}}
    {{--                    </option>--}}
    {{--                @endforeach--}}
    {{--            </select>--}}
    {{--        </div>--}}

    {{--        <div class="form-group {{ $errors->has('customer_email') ? 'has-error' : '' }}">--}}
    {{--            <label for="number">Invoice No</label>--}}
    {{--            <input wire:model="invoice_no" type="text" id="number" name="number" class="form-control"--}}
    {{--                   value="{{ old('number') }}" required>--}}
    {{--            @if($errors->has('number'))--}}
    {{--                <em class="invalid-feedback">--}}
    {{--                    {{ $errors->first('number') }}--}}
    {{--                </em>--}}
    {{--            @endif--}}
    {{--        </div>--}}

    {{--        <div class="form-group {{ $errors->has('date') ? 'has-error' : '' }}">--}}
    {{--            <label for="date">Creation Date</label>--}}
    {{--            <input type="date" name="date" id="date" wire:model="date">--}}
    {{--        </div>--}}

    {{--        <div class="form-group {{ $errors->has('due_date') ? 'has-error' : '' }}">--}}
    {{--            <label for="due_date">Due Date</label>--}}
    {{--            <input type="date" name="due_date" id="due_date" wire:model="due_date">--}}
    {{--        </div>--}}
    {{--        --}}

    {{--        <div class="card mt-4">--}}
    {{--            <div class="card-header">--}}
    {{--                Invoice items--}}
    {{--            </div>--}}

    {{--            <div class="card-body">--}}
    {{--                <table class="table" id="products_table">--}}
    {{--                    <thead>--}}
    {{--                    <tr>--}}
    {{--                        <th>Product</th>--}}
    {{--                        <th width="150">Quantity</th>--}}
    {{--                        <th width="150">Price</th>--}}
    {{--                        <th width="150"></th>--}}
    {{--                    </tr>--}}
    {{--                    </thead>--}}
    {{--                    <tbody>--}}
    {{--                    @foreach ($invoiceProducts as $index => $invoiceProduct)--}}
    {{--                        <tr>--}}
    {{--                            <td>--}}
    {{--                                @if($invoiceProduct['is_saved'])--}}
    {{--                                    <input type="hidden" name="invoiceProducts[{{$index}}][product_id]"--}}
    {{--                                           wire:model="invoiceProducts.{{$index}}.product_id"/>--}}
    {{--                                    @if($invoiceProduct['product_name'] && $invoiceProduct['product_price'])--}}
    {{--                                        {{ $invoiceProduct['product_name'] }}--}}
    {{--                                        (${{ number_format($invoiceProduct['product_price'], 2) }})--}}
    {{--                                    @endif--}}
    {{--                                @else--}}
    {{--                                    <select name="invoiceProducts[{{$index}}][product_id]"--}}
    {{--                                            class="form-control{{ $errors->has('invoiceProducts.' . $index) ? ' is-invalid' : '' }}"--}}
    {{--                                            wire:model="invoiceProducts.{{$index}}.product_id">--}}
    {{--                                        <option value="">-- choose product --</option>--}}
    {{--                                        @foreach ($allProducts as $product)--}}
    {{--                                            <option value="{{ $product->id }}">--}}
    {{--                                                {{ $product->name }} (${{ number_format($product->price, 2) }})--}}
    {{--                                            </option>--}}
    {{--                                        @endforeach--}}
    {{--                                    </select>--}}
    {{--                                    @if($errors->has('invoiceProducts.' . $index))--}}
    {{--                                        <em class="invalid-feedback">--}}
    {{--                                            {{ $errors->first('invoiceProducts.' . $index) }}--}}
    {{--                                        </em>--}}
    {{--                                    @endif--}}
    {{--                                @endif--}}
    {{--                            </td>--}}
    {{--                            <td>--}}
    {{--                                @if($invoiceProduct['is_saved'])--}}
    {{--                                    <input type="hidden" name="invoiceProducts[{{$index}}][quantity]"--}}
    {{--                                           wire:model="invoiceProducts.{{$index}}.quantity"/>--}}
    {{--                                    {{ $invoiceProduct['quantity'] }}--}}
    {{--                                @else--}}
    {{--                                    <input type="number" name="invoiceProducts[{{$index}}][quantity]"--}}
    {{--                                           class="form-control" wire:model="invoiceProducts.{{$index}}.quantity"/>--}}
    {{--                                @endif--}}
    {{--                            </td>--}}
    {{--                            <td>--}}
    {{--                                @if($invoiceProduct['is_saved'])--}}
    {{--                                    <input type="hidden" name="invoiceProducts[{{$index}}][price]"--}}
    {{--                                           wire:model="invoiceProducts.{{$index}}.price"/>--}}
    {{--                                    {{ $invoiceProduct['product_price'] }}--}}
    {{--                                @else--}}
    {{--                                    <input type="number" name="invoiceProducts[{{$index}}][price]"--}}
    {{--                                           class="form-control" wire:model="invoiceProducts.{{$index}}.price"/>--}}
    {{--                                @endif--}}
    {{--                            </td>--}}
    {{--                            <td>--}}
    {{--                                @if($invoiceProduct['is_saved'])--}}
    {{--                                    <button class="btn btn-sm btn-primary"--}}
    {{--                                            wire:click.prevent="editProduct({{$index}})">--}}
    {{--                                        Edit--}}
    {{--                                    </button>--}}
    {{--                                @elseif($invoiceProduct['product_id'])--}}
    {{--                                    <button class="btn btn-sm btn-success mr-1"--}}
    {{--                                            wire:click.prevent="saveProduct({{$index}})">--}}
    {{--                                        Save--}}
    {{--                                    </button>--}}
    {{--                                @endif--}}
    {{--                                <button class="btn btn-sm btn-danger"--}}
    {{--                                        wire:click.prevent="removeProduct({{$index}})">Delete--}}
    {{--                                </button>--}}
    {{--                            </td>--}}
    {{--                        </tr>--}}
    {{--                    @endforeach--}}
    {{--                    </tbody>--}}
    {{--                </table>--}}

    {{--                <div class="row">--}}
    {{--                    <div class="col-md-12">--}}
    {{--                        <button class="btn btn-sm btn-secondary"--}}
    {{--                                wire:click.prevent="addProduct">+ Add Product--}}
    {{--                        </button>--}}
    {{--                    </div>--}}
    {{--                </div>--}}

    {{--                <div class="col-lg-5 ml-auto text-right">--}}
    {{--                    <table class="table pull-right">--}}
    {{--                        <tr>--}}
    {{--                            <th>Subtotal</th>--}}
    {{--                            <td>${{ number_format($subtotal, 2) }}</td>--}}
    {{--                        </tr>--}}
    {{--                        <tr>--}}
    {{--                            <th>Taxes</th>--}}
    {{--                            <td width="125">--}}
    {{--                                <input type="number" name="taxes" class="form-control w-75 d-inline"--}}
    {{--                                       min="0" max="100" wire:model="taxes">--}}
    {{--                                %--}}
    {{--                            </td>--}}
    {{--                        </tr>--}}
    {{--                        <tr>--}}
    {{--                            <th>Total</th>--}}
    {{--                            <td>${{ number_format($total, 2) }}</td>--}}
    {{--                        </tr>--}}
    {{--                    </table>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--        <br/>--}}
    {{--        <div>--}}
    {{--            <input class="btn btn-primary" type="submit" value="Save Invoice">--}}
    {{--        </div>--}}
    {{--    </form>--}}
    {{--</div>--}}

</div>

<div class="container">
    <div class="card">

        <form wire:submit.prevent="saveInvoice">

            <div class="card-header">
                <div class="row">
                    {{-- Left Side Master --}}
                    <div class="col-md-5">
                        <div class="col-xs-2">
                            <label for="number" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Invoice No.</label>
                            <input type="text" name="number" id="number" wire:model="number"
                                   class="appearance-none block w-50 bg-gray-200 text-gray-700 border border-red-500 rounded
                                   py-2 px-2 mb-2
                                   leading-tight focus:outline-none focus:bg-white">

                            <label for="date"class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Creation Date</label>
                            <input type="date" name="date" id="date" wire:model="date"
                                   class="appearance-none block w-50 bg-gray-200 text-gray-700 border border-red-500 rounded
                                   py-2 px-2 mb-2
                                   leading-tight focus:outline-none focus:bg-white">

                            <label for="due_date"class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Due Date</label>
                            <input type="date" name="due_date" id="due_date" wire:model="due_date"
                                   class="appearance-none block w-50 bg-gray-200 text-gray-700 border border-red-500 rounded py-2 px-2 mb-2 leading-tight focus:outline-none focus:bg-white">
                        </div>
                    </div>

                    {{-- Right Side Master --}}
                    <div class="col-md-5">

                        <label for="associate_id"class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Customer name</label>
                        <select name="associate_id"
                                class="block appearance-none w-50 bg-gray-200 border border-gray-200 text-gray-700 py-2 px-2 mb-2 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                wire:model="associate_id">
                            <option value="" placeholder="Customers..."></option>
                            @isset($associates)
                            @foreach ($associates as $associate)
                                <option value="{{ $associate->id }}" selected>
                                    {{ $associate->name }}
                                </option>
                            @endforeach
                            @endisset
                        </select>

                        <label for="type"class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Invoice type</label>
                        <select name="type"
                                class="block appearance-none w-50 bg-gray-200 border border-gray-200 text-gray-700 py-2 px-2 mb-2 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                wire:model="type">
                            <option value="">-- choose type --</option>
                            @isset($types)
                            @foreach ($types as $item)
                                <option value="{{ $item->id }}">
                                    {{ $item->name }}
                                </option>
                            @endforeach
                            @endisset
                        </select>

                    </div>

                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    {{--        SEARCH BOX - TODO: Include this from component --}}
                    <div class="col-md-8 align-content-center z-50">

                        <input type="search" class="bg-purple-white shadow rounded border-0 p-3"
                               wire:model="searchProduct" name="search" id="search"
                               autocomplete="off"
                               placeholder="Search by product name...">
                        <div class="absolute pin-r pin-t mt-3 mr-4 text-purple-lighter">

                        </div>
                        <ul class="list-group">
                            @isset($products)
                            @foreach($products as $product)
                                <li wire:click="selectedProduct({{$product->id}})"
                                    wire:model="results"
                                    class="list-group-item list-group-item-action shadow">
                                    {{ $product->name }} ( {{ $product->price }})
                                </li>
                            @endforeach
                            @endisset
                        </ul>

                    </div>
                </div>
                {{-- END SEARCH --}}

                {{--        ITEMS           --}}
                <br>

                <table class="min-w-full leading-normal rounded shadow">
                    <thead class="justify-between">
                    <tr class="bg-gray-800">
                        <th class="px-4 py-2"><span class="text-gray-300">#</span></th>
                        <th class="px-4 py-2"><span class="text-gray-300">PID</span></th>
                        <th class="px-4 py-2"><span class="text-gray-300">Product</span></th>
                        <th class="px-4 py-2"><span class="text-gray-300">Price</span></th>
                        <th class="px-4 px-2"><span class="text-gray-300">Quantity</span></th>
                        <th class="px-4 py-2"><span class="text-gray-300">Tax (%)</span></th>
                        <th class="px-4 py-2"><span class="text-gray-300">Sub total</span></th>
                        <th class="px-4 py-2"><span class="text-gray-300">Tax total</span></th>
                        <th class="px-4 py-2"><span class="text-gray-300">TOTAL</span></th>
                        <th></th>
                    </tr>
                    </thead>

                    <tbody class="bg-gray-200">
                    @isset($list)
                    @foreach($list as $index => $item)
                        <tr class="bg-white border-2 border-gray-200">
                            <td class="px-4 py-2">{{ $item['id'] ?? $index }}</td>
                            <td class="px-4 py-2">{{ $item['products']['id'] ?? $item['product_id'] ?? ''}}</td>
                            <td class="px-4 py-2">{{ $item['products']['name'] ?? $item['name'] ?? ''}}</td>
                            <td class="px-4 py-2 text-right">{{  $item['price'] ?? ''}}</td>
                            <td class="px-4 py-2">
                                <input type="number" placeholder="0.00" name="list[{{$index}}][quantity]"
                                       style="width: 80px"
                                       class="mb-1 bg-gray-100 p-1 rounded-lg shadow-md focus:outline-none focus:border-indigo-600" wire:model="list.{{$index}}.quantity"/>
                            </td>

                            <td class="px-4 py-2 text-right">{{$item['tax']}}</td>

                            @php
                                $item_sub_total = $item['price'] * ($item['quantity'] ?? 1);
                                $item_tax_total = $item_sub_total * ($item['tax']/100.00);
                                $item_total = $item_sub_total + $item_tax_total;
                                $list[$index]['sub_total'] = $item_sub_total;
                                $list[$index]['tax_total'] = $item_tax_total;
                            @endphp

{{--                            <input class="px-4 py-2 text-right" type="hidden" name="list[{{$index}}][sub_total]" wire:model="list.{{$index}}.sub_total"/>--}}
                            <td class="px-4 py-2 text-right" wire:model="sub_total">{{$list[$index]['sub_total']}}</td>
                            <td class="px-4 py-2 text-right" wire:model="tax_total">{{$list[$index]['tax_total']}}</td>
                            <td class="px-4 py-2 text-right">{{$item_total}}</td>

                            <td class="px-4 py-2">
                                <a href="#" wire:click="deleteId({{ $index}})"
                                   data-toggle="modal" data-target="#exampleModal">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 hover:text-pink-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z" />
                                        <path fill-rule="evenodd" d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </a>


{{--                                <span class=""--}}
{{--                                    data-toggle="modal"--}}
{{--                                      data-index-number="{{$item['id']}}"--}}
{{--                                      data-target="#exampleModal">--}}
{{--                                    <i class="fa fa-trash hover:shadow-lg hover:colors-red-300"></i></span>--}}
                            </td>

                        </tr>
                    @endforeach
                    @endisset
                    </tbody>
                    <tfoot>
                    <div class="flex flex-col justify-right items-right">
                        <tr>
                            <td colspan="7" class="text-right py-2">SUB TOTAL:</td>
                            <td class="text-right">{{$sub_total ?? 0}}</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td colspan="7" class="text-right py-2">TAX TOTAL:</td>
                            <td class="text-right">{{$tax_total ?? 0}}</td>
                        </tr>
                        <tr>
                            <td colspan="7" class="text-right py-2">TOTAL:</td>
                            <td class="text-right">{{$total ?? 0}}</td>
                        </tr>
                    </div>
                    </tfoot>
                </table>

                <!-- Modal -->
                <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Delete Confirm</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true close-btn">??</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure want to delete?</p>
                                <p id="data.indexNumber">Index:{{$item['id'] ?? '-'}}</p>
                                <input type="text" >
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
                                <button type="button" wire:click.prevent="removeProduct()" class="btn btn-danger close-modal" data-dismiss="modal">Yes, Delete</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-footer">
                <button type="submit" value="Save Invoice"
                        class="inline-block px-6 py-2 font-medium leading-7 text-center text-blue-700 uppercase transition bg-transparent border-2 border-blue-700 rounded shadow ripple hover:shadow-lg hover:bg-blue-100 focus:outline-none waves-effect"
                >
                    SAVE
                </button>
                {{--                <input class="btn btn-primary" type="submit" value="Save Invoice">--}}
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

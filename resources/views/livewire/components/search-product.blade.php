{{--<div class="card">--}}

{{--    <div class="card-header">--}}
{{--        <div class="row">--}}

{{--            --}}{{-- Left Side Master --}}
{{--            <div class="col-md-5">--}}
{{--                <div class="col-xs-2">--}}
{{--                    <label for="number">Invoice No.</label>--}}
{{--                    <input type="text" name="number" id="number" class="form-control">--}}

{{--                    <label for="date">Creation Date</label>--}}
{{--                    <input type="date" name="date" id="date" class="form-control">--}}

{{--                    <label for="due_date">Due Date</label>--}}
{{--                    <input type="date" name="due_date" id="due_date" class="form-control">--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            --}}{{-- Right Side Master --}}
{{--            <div class="col-md-5">--}}

{{--                <label for="associate_id">Customer name</label>--}}
{{--                <select name="associate_id"--}}
{{--                        class="form-control"--}}
{{--                        wire:model="associate_id">--}}
{{--                    <option value="">-- choose customer --</option>--}}
{{--                    @foreach ($associates as $associate)--}}
{{--                        <option value="{{ $associate->id }}">--}}
{{--                            {{ $associate->name }}--}}
{{--                        </option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}

{{--                <label for="type">Invoice type</label>--}}
{{--                <select name="type"--}}
{{--                        class="form-control"--}}
{{--                        wire:model="type">--}}
{{--                    <option value="">-- choose type --</option>--}}
{{--                    @foreach ($types as $item)--}}
{{--                        <option value="{{ $item->id }}">--}}
{{--                            {{ $item->name }}--}}
{{--                        </option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}

{{--            </div>--}}

{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="card-body">--}}
{{--    <label for="search">Search</label>--}}
{{--    <input type="text" wire:model="searchProduct" name="search" id="search" class="form-control" autocomplete="off">--}}
{{--    <ul class="list-group">--}}
{{--        @foreach($products as $product)--}}
{{--            <li wire:click="selectedProduct({{$product->id}})" wire:model="results" class="list-group-item list-group-item-action">--}}
{{--                {{ $product->name }} ( {{ $product->price }})--}}
{{--            </li>--}}

{{--        @endforeach--}}
{{--    </ul>--}}
{{--    <br>--}}
{{--    <table class="table table-striped table-responsive-md">--}}
{{--        <thead>--}}
{{--        <tr>--}}
{{--            <th>#</th>--}}
{{--            <th>Product Name</th>--}}
{{--            <th>Price</th>--}}
{{--            <th>Quantity</th>--}}
{{--            <th class="text-right">Total</th>--}}
{{--            <th></th>--}}
{{--        </tr>--}}
{{--        </thead>--}}

{{--        <tbody>--}}
{{--        @foreach($list as $index => $item)--}}
{{--            <tr>--}}
{{--                <td>{{$item['id']}}</td>--}}
{{--                <td>{{$item['name']}}</td>--}}
{{--                <td>{{$item['price']}}</td>--}}

{{--                <td>--}}
{{--                    <input type="hidden" name="list[{{$index}}][quantity]"--}}
{{--                           wire:model="list.{{$index}}.quantity"/>--}}
{{--                    {{ $list['quantity'] ?? 0 }}--}}

{{--                    <input type="number" placeholder="0.00"   name="list[{{$index}}][quantity]"--}}
{{--                           class="form-control col-4" wire:model="list.{{$index}}.quantity"/>--}}
{{--                    --}}{{-- pattern="^\d*(\.\d{0,2})?$" --}}
{{--                </td>--}}

{{--                <td class="text-right">--}}
{{--                    {{$item['total'] * ($item['quantity'] ?? 1)}}--}}
{{--                </td>--}}

{{--                <td>--}}
{{--                    <button class="btn btn-sm btn-danger"--}}
{{--                            wire:click.prevent="removeProduct({{$index}})">Delete--}}
{{--                    </button>--}}
{{--                </td>--}}

{{--            </tr>--}}
{{--        @endforeach--}}
{{--        </tbody>--}}
{{--        <tfoot>--}}
{{--        <tr>--}}
{{--            <td colspan="4" class="text-right">TOTAL:</td>--}}
{{--            <td class="text-right">{{$total}}</td>--}}
{{--        </tr>--}}
{{--        </tfoot>--}}
{{--    </table>--}}
{{--    <div>--}}

{{--    </div>--}}
{{--    </div>--}}
{{--</div>--}}

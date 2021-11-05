@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-13">
                <div class="card">
                    <div class="card-header">{{ __('Create invoice') }}</div>

                    <div class="card-body">
                        <form action="{{ route('invoices.store') }}" method="POST">
                            @csrf
                            {{--Start Invoice table--}}
                            <div class="container">
                                <div class="row clearfix">

                                    <div class="col-md-3 offset-0 text-left pb-5">
                                        <input type="hidden" name="invoice[id]"
                                               @if(isset($invoice->id)) value="{{$invoice->id}}@endif">

                                        <label for="number" class="col-form-label-sm pb-0 mb-0">Number</label>
                                        <input type="text" id="number" name="invoice[number]"
                                               class="form-control" placeholder="DM001" required
                                               @if(isset($invoice->number)) value="{{$invoice->number}}@endif">
                                        <label for="associate_id">Associate</label>

                                        <select name="invoice[associate_id]" id="associate_id" class="form-control">
                                            <option value="">--- select ---</option>
                                            @foreach($associates as  $associate)
                                                <option value="{{$associate->id}}"
                                                        @if(isset($invoice->associates->id) && $invoice->associates->id === $associate->id) selected
                                                        @elseif(isset($associate_id) && intval($associate_id) === $associate->id) selected @endif>{{$associate->name}}</option>
                                            @endforeach
                                        </select>

                                    </div>

                                    <div class="col-md-3 offset-0 text-left pb-5">
                                        <label for="invoice_date" class="col-form-label-sm pb-0 mb-0">Date</label>
                                        <input type="date" id="invoice_date" name="invoice[date]"
                                               class="form-control" required
                                               @if(isset($invoice->date)) value="{{$invoice->date}}"
                                               @else value="{{ date('Y-m-d') }}"@endif>
                                    </div>

                                    <div class="col-md-3 offset-0 text-left pb-5">
                                        <label for="invoice_due_date" class="col-form-label-sm pb-0 mb-0">Due
                                            date</label>
                                        <input type="date" id="invoice_due_date" name="invoice[due_date]"
                                               class="form-control" required
                                               @if(isset($invoice->date)) value="{{$invoice->date}}"
                                               @else value="{{ date('Y-m-d') }}" @endif>
                                    </div>

                                    <div class="col-md-12">
                                        <table class="table table-hover tab_logic" id="tab_logic">
                                            <thead class="thead" style="background-color: #02427c; color: white;">
                                            <tr>
                                                <th class="text-center col-sm-0"> #</th>
                                                <th class="text-center col-md-4"> Product</th>
                                                <th class="text-center"> Qty</th>
                                                <th class="text-center"> Price</th>
                                                <th class="text-center"> Tax</th>
                                                <th class="text-center"> Total Without Tax</th>
                                                <th class="text-center"> Total Tax</th>
                                                <th class="text-center"> Total</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @isset($invoice)
                                                @foreach($invoice->invoice_items as $item)
                                                    <tr id='addr0'>
                                                        <td>{{$item->id}}</td>
                                                        <td>
                                                            <select name="invoice_detail[product_id][]"
                                                                    class="form-control products">
                                                                <option value="">--- select ---</option>
                                                                @foreach($products as $product)
                                                                    <option value="{{$product->id}}" @if($item->product_id === $product->id) selected @endif >{{$product->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>

                                                        <td><input type="number" name='invoice_detail[quantity][]'
                                                                   placeholder='Enter Qty' class="form-control qty"
                                                                   step="0" min="0"
                                                                   @isset($item->quantity) value="{{$item->quantity}}" @endif /></td>
                                                        <td><input type="number" name='invoice_detail[price][]'
                                                                   placeholder='Enter Unit Price'
                                                                   class="form-control price"
                                                                   step="0.00" min="0"
                                                                   @isset($item->price) value="{{$item->price}}" @endif /></td>
                                                        <td><input type="number" name='invoice_detail[tax][]'
                                                                   placeholder='0.00'
                                                                   class="form-control tax"
                                                                   @isset($item->tax) value="{{$item->tax}}" @endif/></td>
                                                        <td><input type="number"
                                                                   name='invoice_detail[total_without_tax][]'
                                                                   placeholder='0.00'
                                                                   class="form-control total_without_tax"
                                                                   readonly
                                                                   @isset($item->total_without_tax) value="{{$item->total_without_tax}}" @endif/></td>
                                                        <td><input type="number" name='invoice_detail[total_tax][]'
                                                                   placeholder='0.00' class="form-control total_tax"
                                                                   readonly
                                                                   @isset($item->total_tax) value="{{$item->total_tax}}" @endif/>
                                                        </td>
                                                        <td><input type="number" name='invoice_detail[total][]'
                                                                   placeholder='0.00'
                                                                   class="form-control total" readonly
                                                                   @isset($item->total) value="{{$item->total}}" @endif/></td>
{{--                                                        <td><a href="{{route('invoices-details.destroy', $item->id)}}" class="btn btn-sm btn-danger" id="del-{{$item->id}}">Delete</a></td>--}}
{{--                                                        <td><i class="far fa-trash-alt deleteRecord" data-id="{{ $item->id }}"></i></td>--}}
                                                        <td>
                                                            <a href="#" class="btn btn-sm btn-outline-danger deleteRecord" data-id="{{ $item->id }}">
                                                            <i class="far fa-trash-alt"></i>
                                                            </a>
                                                        </td>


                                                    </tr>
                                                    <tr id='addr1'></tr>
                                                @endforeach

                                            @else(!$invoice)
                                                <tr id='addr0'>
                                                    <td>1</td>
                                                    <td>
                                                        <select name="invoice_detail[product_id][]"
                                                                class="form-control products">
                                                            <option value="">--- select ---</option>
                                                            @foreach($products as $product)
                                                                <option
                                                                    value="{{$product->id}}">{{$product->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>

                                                    <td><input type="number" name='invoice_detail[quantity][]'
                                                               placeholder='Enter Qty' class="form-control qty" step="0"
                                                               min="0"/></td>
                                                    <td><input type="number" name='invoice_detail[price][]'
                                                               placeholder='Enter Unit Price' class="form-control price"
                                                               step="0.00" min="0"/></td>
                                                    <td><input type="number" name='invoice_detail[tax][]'
                                                               placeholder='0.00'
                                                               class="form-control tax" value=""/></td>
                                                    <td><input type="number" name='invoice_detail[total_without_tax][]'
                                                               placeholder='0.00' class="form-control total_without_tax"
                                                               readonly/></td>
                                                    <td><input type="number" name='invoice_detail[total_tax][]'
                                                               placeholder='0.00' class="form-control total_tax"
                                                               readonly/>
                                                    </td>
                                                    <td><input type="number" name='invoice_detail[total][]'
                                                               placeholder='0.00'
                                                               class="form-control total" readonly/></td>
                                                    <td></td>
                                                </tr>
                                                <tr id='addr1'></tr>
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <input id="add_row" class="btn btn-outline-success float-left" value="Add Row">
                                        <input id='delete_row' class="btn btn-outline-danger float-right" value="Delete">

                                    </div>
                                </div>

                                {{--Totals--}}
                                <div class="row clearfix" style="margin-top:20px">
                                    <div class="col-md-12">
                                        <div class="float-right col-md-6">
                                            <table class="table table-bordered table-hover" id="tab_logic_total">
                                                <tbody>
                                                <tr>
                                                    <th class="text-center" width="50%">Sub Total</th>
                                                    <td class="text-center"><input type="number"
                                                                                   name='invoice[invoice_sub_total]'
                                                                                   id='invoice_sub_total'
                                                                                   placeholder='0.00'
                                                                                   class="form-control" id="sub_total"
                                                                                   readonly
                                                                                   @isset($invoice->invoice_sub_total) value="{{$invoice->invoice_sub_total}}" @endisset/></td>
                                                </tr>
                                                <tr>
                                                </tr>
                                                <tr>
                                                    <th class="text-center">Tax Amount</th>
                                                    <td class="text-center"><input type="number" name='invoice[tax_amount]'
                                                                                   id="tax_amount" placeholder='0.00'
                                                                                   class="form-control" readonly
                                                                                   @isset($invoice->tax_amount) value="{{$invoice->tax_amount}}" @endisset/></td>
                                                </tr>
                                                <tr>
                                                    <th class="text-center">Grand Total</th>
                                                    <td class="text-center"><input type="number" name='invoice[total_amount]'
                                                                                   id="total_amount" placeholder='0.00'
                                                                                   class="form-control" readonly
                                                                                   @isset($invoice->total_amount) value="{{$invoice->total_amount}}" @endisset/></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--End Invoice table--}}
                            @isset($invoice->id)
                                <input type="submit" class="btn btn-primary col-md-2" value="Update">
                            @else
                            <input type="submit" class="btn btn-success col-md-2" value="Save">
                            @endisset
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        let token = $('meta[name="csrf-token"]').attr('content');

        $(document).ready(function () {
            event.preventDefault();

            let i = 1;
            $("#add_row").click(function () {
                b = i - 1;
                $('#addr' + i).html($('#addr' + b).html()).find('td:first-child').html(i + 1);
                $('#tab_logic').append('<tr id="addr' + (i + 1) + '">' + '</tr>');
                i++;

                console.log('index: ' + i);
            });

            $("#delete_row-").click(function () {
                console.log('delete test');
                if (i > 1) {
                    $("#addr" + (i - 1)).html('');
                    i--;
                }
                calc();
            });

            $(".deleteRecord").click(function(){
                var id = $(this).data("id");
                var token = $("meta[name='csrf-token']").attr("content");
                let url = '{{route('invoices-details.destroy', ':id')}}';
                url = url.replace(':id', id);
                $.ajax(
                    {
                        url: url,
                        type: 'DELETE',
                        data: {
                            "id": id,
                            "_token": token,
                        },
                        success: function (){
                            console.log("Deleted");
                        }
                    });

            });

            $('#tab_logic tbody').on('keyup change', function () {
                calc();
            });

            $('#tax').on('keyup change', function () {
                calc_total();
            });

            //Get product price
            $("body").on("change", ".products", function () {

                let pid = $(this).val();
                let price = $(this).parents("tr").find(".price");
                let tax = $(this).parents("tr").find(".tax");
                let qty = $(this).parents("tr").find(".qty");
                let id = $(this).val()
                let url = '{{route('products.show', ':id')}}'
                url = url.replace(':id', id);
                $.ajax({
                    url: url,
                    type: "get",
                    data: {pid: pid},
                    success: function (res) {
                        $(qty).val(1);
                        $(price).val(res.price);
                        $(tax).val(res.tax);
                        calc();
                    }
                });
            });
        });

        function get_product(id, token) {
            let url = '{{route('products.show', ':id')}}'
            url = url.replace(':id', id);

            return new Promise(function (resolve, reject) {
                $.ajax({
                    url: url,
                    method: "GET",
                    data: {_token: token, id: id},
                    dataType: 'json',
                    success: function (data) {
                        resolve(data) // Resolve promise and go to then()
                    },
                    error: function (err) {
                        reject(err) // Reject the promise and go to catch()
                    }
                });
            });
        }

        function calc() {
            $('#tab_logic tbody tr').each(function (i, element) {
                let html = $(this).html();
                if (html !== '') {
                    let total = 0;
                    let total_without_tax = 0;
                    let total_tax = 0;

                    let qty = $(this).find('.qty').val();
                    let price = $(this).find('.price').val();
                    let tax = $(this).find('.tax').val();
                    $(this).find('.total_without_tax').val(qty * price);
                    if (tax > 0) {
                        let tax_c = (1 + (tax / 100));

                        total_without_tax = qty * price;
                        total = total_without_tax * tax_c;
                        total_tax = total - total_without_tax;
                    } else {
                        total_without_tax = qty * price;
                        total = total_without_tax;
                    }
                    $(this).find('.total_without_tax').val(total_without_tax);
                    $(this).find('.total').val(total);
                    $(this).find('.total_tax').val(total_tax);

                    calc_total();
                }
            });
        }

        function calc_total() {
            // osnovica
            let invoice_sub_total = 0;
            $('.total_without_tax').each(function () {
                console.log($(this).val())
                invoice_sub_total += parseInt($(this).val());
            });
            console.log('Sub total: ' + invoice_sub_total);
            $('#invoice_sub_total').val(invoice_sub_total.toFixed(2));

            // Porez
            let invoice_tax_total = 0;
            $('.total_tax').each(function () {
                invoice_tax_total += parseInt($(this).val());
            });
            $('#tax_amount').val(invoice_tax_total.toFixed(2));

            // Total
            let invoice_total = 0;
            $('.total').each(function () {
                invoice_total += parseInt($(this).val());
            });
            $('#total_amount').val((invoice_total).toFixed(2));
        }
    </script>
@endsection

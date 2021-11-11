@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Invoices</div>

                    <a href="{{ route('invoices.create') }}" class="btn btn-outline-secondary p-2">
                        <span><i class="fas fa-external-link-alt"></i></span>
                        NEW Invoice
                    </a>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table class="table">
                            <tr>
                                <th>#</th>
                                <th>Number</th>
                                <th>Date</th>
                                <th>Due Date</th>
                                <th>Customer</th>
                                <th class="text-right">Total Amount</th>
                                <th></th>
                            </tr>
                            @foreach ($invoices as $key => $invoice)
                                <tr>
                                    <td>{{ ($invoices->currentpage()-1) * $invoices->perpage() + $loop->index + 1 }}</td>
                                    <td><span class="badge-primary rounded p-1">{{ $invoice->number }}</span></td>
                                    <td>{{ $invoice->date }}</td>
                                    <td>{{ $invoice->due_date }}</td>
                                    <td>{{ $invoice->associates->name ?? '' }}</td>
                                    <td class="text-right">{{ number_format($invoice->total, 2) }}</td>
                                    <td>
                                        <a href="{{ route('invoices.show', $invoice->id) }}" class="btn btn-sm btn-outline-secondary"><i class="far fa-file-alt"></i></a>
                                        <a href="{{ route('invoices.edit', $invoice->id) }}" class="btn btn-sm btn-outline-secondary"><i class="far fa-edit"></i></a>
                                        <a href="{{ route('invoices.download', $invoice->id) }}" class="btn btn-sm btn-outline-secondary"><i class="far fa-file-pdf"></i></a>
                                        <button class="btn btn-danger btn-sm" onclick="handleDelete({{ $invoice->id }})"><i class="fas fa-trash-alt" aria-hidden="true"></i>
                                        </button>
                                    </td>
                                </tr>

                            @endforeach
                            <tr>
                                <td colspan="6" class="text-right" style="font-weight: bold">
                                    @if(isset($invoice))  {{ number_format($invoice->sum('total'), 2) }} @endif
                                </td>
                            </tr>
                        </table>
                        <div class="d-flex justify-content-center pagination">
                            {{ $invoices->links() }}
                        </div>

                        {{-- Modal--}}
                        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
                             aria-hidden="true">

                            <div class="modal-dialog" role="document">
                                <form action="" method="POST" id="deleteForm">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel">Delete Invoice</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p class="text-center text-secondary">
                                                Are you sure you want to delete this Invoice ?
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                                    onclick="close_modal()">Cancel
                                            </button>
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        {{-- End Modal--}}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function handleDelete(id) {

            var form = document.getElementById('deleteForm')
            form.action = '/invoices/' + id + '/destroy'
            $('#deleteModal').modal('show')

        }

        function close_modal() {
            $('#deleteModal').modal('hide')
        }


        $('input[type=search]').on('search', function () {
            this.form.submit();
        });


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('click', 'a.jquery-delete', function (e) {
            e.preventDefault();

            let $this = $(this);

            $.post({
                type: $this.data('method'),
                url: $this.attr('href'),
                {{--_token: '{{csrf_token()}}',--}}
            }).done(function (data) {
                alert('success');
                console.log(data);
            });
        });
    </script>
@endsection

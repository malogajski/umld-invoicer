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
                                    <td>{{ $invoice->associates->name }}</td>
                                    <td class="text-right">{{ number_format($invoice->total_amount, 2) }}</td>
                                    <td>
                                        <a href="{{ route('invoices.show', $invoice->id) }}" class="btn btn-sm btn-outline-secondary"><i class="far fa-file-alt"></i></a>
                                        <a href="{{ route('invoices.edit', $invoice->id) }}" class="btn btn-sm btn-outline-secondary"><i class="far fa-edit"></i></a>
                                        <a href="{{ route('invoices.download', $invoice->id) }}" class="btn btn-sm btn-outline-secondary"><i class="far fa-file-pdf"></i></a>
                                    </td>
                                </tr>

                            @endforeach
                            <tr>
                                <td colspan="6" class="text-right" style="font-weight: bold">
                                  @if(isset($invoice))  {{ number_format($invoice->sum('total_amount'), 2) }} @endif
                                </td>
                            </tr>
                        </table>
                            <div class="d-flex justify-content-center pagination">
                                {{ $invoices->links() }}
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

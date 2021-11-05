<?php

namespace App\Http\Controllers\Invoices;

use App\Http\Controllers\Controller;
use App\Models\Codebooks\Associate;
use App\Models\Codebooks\Product;
use App\Models\Invoices\Invoice;
use App\Models\Invoices\InvoiceDetail;
use FontLib\TrueType\Collection;
use Http;
use Illuminate\Http\Request;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $invoices = Invoice::with('customer')->take(2);
//        return view('home', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $associates = Associate::all();
        $products = Product::all();
        $associate_id = null;
        if ($request->input('associate_id')) {
            $associate_id = $request->input('associate_id');
        }
        return view('invoices.create', compact(['associates', 'products', 'associate_id']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $arr = $request->all();

        $invoice_id = $request->invoice['id'] ?? null;

        if (!$invoice_id) {
            $invoice = Invoice::create($request->invoice + ['user_id' => auth()->id()]);
            $invoice_id = $invoice->id;
        } else {
            $invoice = Invoice::find($invoice_id)->update($request->invoice + ['user_id' => auth()->id()]);
        }

        $invoice_details = $request->invoice_detail;

        for ($i = 0; $i < count($invoice_details); $i++) {
            if (isset($invoice_details['quantity'][$i]) && isset($invoice_details['price'][$i])) {

                $details = InvoiceDetail::where('parent_id', $invoice_id)->where('product_id', $invoice_details['product_id'][$i])->first();

                $data = [
                    'parent_id'         => $invoice_id,
                    'product_id'        => $invoice_details['product_id'][$i],
                    'quantity'          => $invoice_details['quantity'][$i],
                    'price'             => $invoice_details['price'][$i],
                    'tax'               => $invoice_details['tax'][$i],
                    'total_without_tax' => $invoice_details['total_without_tax'][$i],
                    'total_tax'         => $invoice_details['total_tax'][$i],
                    'total'             => $invoice_details['total'][$i],
                ];
                if (empty($details)) {
                    InvoiceDetail::create($data);
                } else {
//                    dd('update item');
                    InvoiceDetail::where('id', $details->id)->update($data);
                }
            }
        }
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoice = Invoice::findOrFail($id);

        return view('invoices.show', compact('invoice'));
    }

    public function download($id)
    {
        $invoice = Invoice::findOrFail($id);
        $pdf = \PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
            ->loadView('invoices.pdf', compact('invoice'));

        return $pdf->stream('invoice.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $products = Product::all();
        $associates = Associate::all();
        $invoice = Invoice::with('invoice_items', 'associates')->find($id);
//        dd($invoice);
        return view('invoices.create', compact(['associates', 'products', 'invoice']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

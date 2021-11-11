<?php

namespace App\Http\Controllers\Invoices;

use App\Models\Invoices\Invoice;
use App\Models\Invoices\InvoiceDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InvoicesDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd('store');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd('show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dd('edit');
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
        dd('update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $items = InvoiceDetail::findOrFail($id);
        $items->delete();

        $data = [
            'tax_total' => InvoiceDetail::where('parent_id', $items->parent_id)->sum('total_tax'),
            'sub_total' => InvoiceDetail::where('parent_id', $items->parent_id)->sum('total_without_tax'),
            'total'     => InvoiceDetail::where('parent_id', $items->parent_id)->sum('total'),
        ];

        Invoice::where('id', $items->parent_id)->update($data);

        return redirect()->back();
    }

}

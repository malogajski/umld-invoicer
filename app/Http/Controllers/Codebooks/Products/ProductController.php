<?php

namespace App\Http\Controllers\Codebooks\Products;

use App\Http\Controllers\Controller;
use App\Models\Codebooks\Product;
use Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(5);
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $host_id = auth()->user()->host_id;

        $rules = [
            'name'       => 'required|string|min:1max:255',
            'description' => 'nullable|string|max:255',
            'sku'        => 'nullable|string|max:50',
            'barcode'    => 'nullable|string|max:50',
            'price'      => 'required|numeric|min:0',
            'tax'        => 'required|numeric|min:0|max:50',
        ];

        $data = $request->all();

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        }

        Product::create([
            'name'        => $data['name'],
            'description' => $data['description'],
            'sku'         => $data['sku'],
            'barcode'     => $data['barcode'],
            'price'       => $data['price'],
            'tax'         => $data['tax'],
            'host_id'     => $host_id,
        ]);

        return Redirect::route('products.index')->with('success', 'Saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Product::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.create', compact('product'));
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

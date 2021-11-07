<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Codebooks\City;
use App\Models\Codebooks\Country;
use App\Models\Host;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class HostController extends Controller
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
        $cities = City::all();
        $countries = Country::all();

        return view('admin.hosts.create-host', compact(['cities', 'countries']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $rules = [
            'name'              => 'required|string|min:1|max:100',
            'description'       => 'required|string|min:1|max:100',
            'tax_id'            => 'required|string|min:1|max:20',
            'number_id'         => 'required|string|min:1|max:20',
            'bank_account'      => 'required|string|min:1|max:30',
            'address'           => 'required|string|min:1|max:50',
            'city_id'           => 'required|exists:cities,id',
            'country_id'        => 'required|exists:countries,id',
            'email'             => 'required|email',
            'web'               => 'nullable|string',
            'resposible_person' => 'nullable"|string|max:50',
            'phone'             => 'nullable|string|max:50',
            'mobile'            => 'nullable|string|max:50',
        ];

        $data = $request->all();
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        } else {
            Host::create($data);
        }

        return Redirect::back()->with('success', 'Host created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        dd($request);
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

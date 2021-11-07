<?php

namespace App\Http\Controllers\Codebooks\Associates;

use App\Enums\Codebooks\AssociateStatus;
use App\Enums\Codebooks\AssociateType;
use App\Http\Controllers\Controller;
use App\Models\Codebooks\Associate;
use App\Models\Codebooks\City;
use App\Models\Codebooks\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AssociateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $associates = Associate::with(['city', 'state', 'country'])->paginate(5);
        return view('associates.index', compact('associates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();
        $types = AssociateType::asArray();
        $statuses = AssociateStatus::asArray();

        return view('associates.create', compact(['countries', 'types', 'statuses']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
//        dd($request->all());
        $host_id = auth()->user()->host_id;

        $rules = [
            'name'                => 'required|string|min:3|max:255',
            'type'                => 'required|string|in:' . implode(',', AssociateType::getValues()),
            'description'         => 'nullable|string',
            'address'             => 'required|string|min:3|max:255',
            'city_id'             => 'required|numeric|exists:cities,id',
            'state_id'            => 'required|numeric|exists:cities,id',
            'country_id'          => 'required|numeric|exists:cities,id',
            'registration_number' => 'required|string|min:4|max:30',
            'pib'                 => 'required|string|min:4|max:30',
            'phone'               => 'required|string|min:4|max:30',
            'mobile'              => 'required|string|min:4|max:30',
            'fax'                 => 'nullable|string|min:4|max:30',
            'email'               => 'required|email',
            'web'                 => 'nullable|string|max:50',
            'responsible_person'  => 'required|string|min:1|max:255',
            'status'              => 'required|in:' . implode(',', AssociateStatus::getValues()),
        ];

        $this->validate($request, $rules);

        $data = $request->all();
        $data['host_id'] = $host_id;
        $data['country_id']  = intval($data['country_id']);
        $data['state_id']  = intval($data['state_id']);
        $data['city_id']  = intval($data['city_id']);

//        dd($data);
        Associate::create($data);

//        Associate::create([
//            'type'                => $data['type'],
//            'description'         => $data['description'],
//            'address'             => $data['address'],
//            'city_id'             => intval($data['city_id']),
//            'state_id'            => intval($data['state_id']),
//            'country_id'          => intval($data['country_id']),
//            'registration_number' => 'required|string|min:4|max:30',
//            'pib'                 => 'required|string|min:4|max:30',
//            'phone'               => 'required|string|min:4|max:30',
//            'mobile'              => 'required|string|min:4|max:30',
//            'fax'                 => 'nullable|string|min:4|max:30',
//            'email'               => 'required|email',
//            'web'                 => 'nullable|string|max:50',
//            'responsible_person'  => 'required|string|min:1|max:255',
//            'status'              => 'required|in:'
//        ]);

        return Redirect::back()->with('success', 'Associate successfully created!');
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

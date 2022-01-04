<?php

namespace App\Http\Controllers\Codebooks;

use App\Http\Controllers\Controller;
use App\Models\Codebooks\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        info(request());
        $cities = City::whereHas('state', function ($query) {
            $query->whereId(request()->input('state_id'), 0);
//            $query->whereId(request()->input('country_id'), 0);
        })->pluck('name', 'id');

        return response()->json($cities);
    }

    public function editCityStateByCountry()
    {
        return view('codebooks.manage-csc-index');
    }
}

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
        })->pluck('name', 'id');

        return response()->json($cities);
    }

}

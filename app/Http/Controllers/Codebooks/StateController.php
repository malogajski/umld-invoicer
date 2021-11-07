<?php

namespace App\Http\Controllers\Codebooks;

use App\Http\Controllers\Controller;
use App\Models\Codebooks\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function index()
    {
        $states = State::whereHas('country', function ($query) {
            $query->whereId(request()->input('country_id', 0));
        })->pluck('name', 'id');

        return response()->json($states);
    }
}

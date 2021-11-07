<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MiscellaneousController extends Controller
{
    public function removeTemporaryImage(Request $request)
    {
        if (!empty($request->input('filename'))) {
            if (Storage::disk('temporary')->exists($request->input('filename'))) {
                Storage::disk('temporary')->delete($request->input('filename'));
            }
        }
    }
}

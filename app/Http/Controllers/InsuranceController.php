<?php

namespace App\Http\Controllers;

use App\Models\Insurance;
use Illuminate\Http\Request;

class InsuranceController extends Controller
{
    //
    public function update(Request $request, $id, $field)
    {
        $option = Insurance::where(['id' => $id])->first();

        $request->validate([
            $field =>  'required|string|max:125',
        ]);

        $option->update([
            $field => $request->$field,
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Option;

use Illuminate\Http\Request;

class OptionController extends Controller
{
    /**
     * Handle an incoming register request.
     */
    public function store(Request $request, $id)
    {
        $request->validate([
            'type' => 'required|string|max:255'
        ]);

        $option = Option::create([
            'type' => $request->type,
            'designation' => $request->designation,
            'quantity' => $request->quantity,
            'unit' => $request->unit,
            'price_ht' => $request->price_ht,
            'moving_job_id' => $id,
        ]);

        return $option->id;
    }

    public function update(Request $request, $id, $field)
    {
        $option = Option::where(['id' => $id])->first();

        $request->validate([
            $field =>  'required|max:255',
        ]);

        $option->update([
            $field => $request->$field,
        ]);
    }
}

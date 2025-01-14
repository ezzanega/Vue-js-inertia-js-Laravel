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
            'unit_price_ht' => $request->unit_price_ht,
            'total_price_ht' => $request->total_price_ht,
            'moving_job_id' => $id,
        ]);

        return $option->id;
    }

    public function update(Request $request, $id)
    {
        $option = Option::where(['id' => $id])->first();

        $validated = $request->validate([
            'designation' => 'required',
            'quantity' => 'required',
            'unit' => 'required',
            'unit_price_ht' => 'required',
            'total_price_ht' => 'required',
        ]);

        $option->update($validated);
    }

    public function delete($id)
    {
        $option = Option::where(['id' => $id])->first();
        $option->delete();
    }
}

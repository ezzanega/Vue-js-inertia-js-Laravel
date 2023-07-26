<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\MovingJobFormula;
use App\Models\MovingJobFormulaOption;

class MovingJobFormulaController extends Controller
{
    public function store(Request $request)
    {
        $organization = $request->user()->organization;
        $options = json_decode($request->options, true);
        $movingJobFormula = $organization->movingJobFormulas()->create([
            'name' => $request->name,
            'slug' => Str::slug($request->slug)
        ]);
        foreach ($options['organization'] as $item) {
            $movingJobFormula->options()->create([
                'type' => 'organization-side',
                'text' => $item,
            ]);
        }
        foreach ($options['client'] as $item) {
            $movingJobFormula->options()->create([
                'type' => 'client-side',
                'text' => $item,
            ]);
        }
        return back();
    }

    public function update(Request $request, $id)
    {
        $movingJobFormula = MovingJobFormula::find($id);
        $movingJobFormula->update([
            'name' => $request->name,
            'slug' => Str::slug($request->slug)
        ]);
        return back();
    }

    public function addOptionToFormula(Request $request, $id)
    {
    }

    public function updateOption(Request $request, $id)
    {
        $movingJobFormula = MovingJobFormulaOption::find($id);
        $movingJobFormula->update([
            'text' => $request->text,
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Settings;
use Illuminate\Http\Request;
use App\Models\Insurance;
use App\Models\MovingJobFormula;
use App\Models\ExecutingCompany;

class SettingsController extends Controller
{

    public function index(Request $request)
    {
        $organization = $request->user()->organization;
        $settings = Settings::where('organization_id', $organization->id)->first();
        $movingJobFormulas = MovingJobFormula::where('organization_id', $organization->id)->with('options')->get();
        $insurances = Insurance::where(['organization_id' => $organization->id])->get();
        $executingCompanies = ExecutingCompany::where(['organization_id' => $organization->id])->get();
        return Inertia::render('6dem/Settings', [
            'settings' => $settings,
            'formulas' => $movingJobFormulas,
            'status' => session('status'),
            'insurances' => $insurances,
            'executingCompanies' => $executingCompanies
        ]);
    }


    public function update(Request $request)
    {
        $organization = $request->user()->organization;
        $settingsData = [
            'quotation_validity_duratation' => $request->quotation_validity_duratation,
            'ducuments_general_conditions' => $request->ducuments_general_conditions,
            'ducuments_primary_color' => $request->ducuments_primary_color,
            'ducuments_secondary_color' => $request->ducuments_secondary_color,
            'legal_notice' => $request->legal_notice,
            'vat' => $request->vat
        ];
        $filledSettingsData = array_filter($settingsData, function ($value) {
            return $value !== null;
        });
        $organization->settings()->update($filledSettingsData);
        return back()->with('status', 'settings-updated');
    }
}

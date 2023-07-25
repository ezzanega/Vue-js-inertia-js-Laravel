<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use Inertia\Inertia;
use Illuminate\Http\Request;

class SettingsController extends Controller
{

    public function index(Request $request)
    {
        $organization = $request->user()->organization;
        $settings = Settings::where('organization_id', $organization->id)->first();
        return Inertia::render('6dem/Settings', [
            'settings' => $settings,
            'status' => session('status'),
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
        ];
        $filledSettingsData = array_filter($settingsData, function ($value) {
            return $value !== null;
        });
        $organization->settings()->update($filledSettingsData);
        return back()->with('status', 'settings-updated');
    }
}

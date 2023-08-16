<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Settings;
use App\Models\Insurance;
use Illuminate\Http\Request;
use App\Models\ExecutingCompany;
use App\Models\MovingJobFormula;
use App\Models\MovingJobFormulaOption;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

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


    public function update_Formulas_option(Request $request,$id)
    {

        $request->validate([
            'text' => 'required|string|min:2',
            'type' => 'required|string|min:3',
        ]);

        $option=MovingJobFormulaOption::where(['id' => $id])->first();

        $option->update([
            'type' => $request->type,
            'text'=> $request->text,
        ]);

        return Redirect::route('6dem.settings');
        //return back();

    }
    public function delete_Formulas_option($id)
    {
        try{
            $option=MovingJobFormulaOption::find($id);
            $option->delete();
            return Redirect::route('6dem.settings');
        } catch (\Exception $e) {

            return response()->json(['message' => 'Une erreur s\'est produite lors de la suppression'], 500);
        }
    }

    public function addOptionToFormula(Request $request)
    {
        $request->validate([
            'text' => 'required|string|min:2|max:300',
        ]);

        try {
            DB::beginTransaction(); // Start a database transaction


            DB::table('moving_job_formula_options')->insert([
                'type' => $request->type,
                'text' => $request->text,
                'moving_job_formula_id' => $request->id_formulas,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::commit(); // Commit the transaction

            return Redirect::route('6dem.settings');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withError('An error occurred while adding the option.');
        }
    }
}

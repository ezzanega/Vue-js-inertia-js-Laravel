<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Settings;
use App\Models\Insurance;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Models\ExecutingCompany;
use App\Models\MovingJobFormula;
use Illuminate\Support\Facades\DB;
use App\Models\MovingJobFormulaOption;
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
            'organization' => Organization::where('id', $organization->id)->with('billingAddress')->first(),
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
            'calendar_meeting_color' => $request->calendar_meeting_color,
            'calendar_moving_color' => $request->calendar_moving_color,
            'calendar_cartons_delivery_color' => $request->calendar_cartons_delivery_color,
            'calendar_others_color' => $request->calendar_others_color,
            'legal_notice' => $request->legal_notice,
            'paiement_process' => $request->paiement_process,
            'vat' => $request->vat,
            'iban' => $request->iban,
            'bic' => $request->bic
        ];
        $filledSettingsData = array_filter($settingsData, function ($value) {
            return $value !== null;
        });
        $organization->settings()->update($filledSettingsData);
        return back()->with('status', 'settings-updated');
    }


    public function update_Formulas_option(Request $request, $id)
    {

        $request->validate([
            'text' => 'required|string|min:2',
            'type' => 'required|string|min:3',
        ]);

        $option = MovingJobFormulaOption::where(['id' => $id])->first();

        $option->update([
            'type' => $request->type,
            'text' => $request->text,
        ]);

        return Redirect::route('6dem.settings');
        //return back();

    }
    public function delete_Formulas_option($id)
    {
        try {
            $option = MovingJobFormulaOption::find($id);
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
    public function update_Formulas(Request $request, $id)
    {
        //return $request->all();
        $request->validate([
            'title_formula' => 'required|string|min:2',
            'slug_formula' => 'required|string',
        ]);

        $formula = MovingJobFormula::where(['id' => $id])->first();

        $formula->update([
            'name' => $request->title_formula,
            'slug' => $request->slug_formula,
        ]);

        return Redirect::route('6dem.settings');
    }
    public function delete_Formulas($id)
    {
        try {
            $formula = MovingJobFormula::where('id', $id)->with('options')->first();
            if ($formula) {
                // Delete the formula
                $formula->delete();
                if ($formula->options->count() > 0) {
                    $formula->options()->delete();
                }
            }
            return Redirect::route('6dem.settings');
            //return $formula . ' ' . $formula_options;
        } catch (\Exception $e) {
            return response()->json(['message' => 'Une erreur s\'est produite lors de la suppression de ce moving job formulas'], 500);
        }
    }
    public function create_Formulas(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'options' => 'nullable|array',
            'options.*.option' => 'required|string|max:255',
            'options.*.type' => 'required|string|max:255',
        ]);
        //return $request->all();
        // // Create a new MovingJobFormula and save the title and slug and organisation is
        $organization = $request->user()->organization;
        $formula = new MovingJobFormula();
        $formula->name = $validatedData['title'];
        $formula->slug = $validatedData['slug'];
        $formula->organization_id = $organization->id;
        $formula->save();

        //Save the options in MovingJobFormulaOptions
        if (isset($validatedData['options']) && is_array($validatedData['options'])) {
            foreach ($validatedData['options'] as $option) {
                $formulaOption = new MovingJobFormulaOption();
                $formulaOption->type =  $option['type'];
                $formulaOption->moving_job_formula_id = $formula->id;
                $formulaOption->text = $option['option'];
                $formulaOption->save();
            }
        }
        return Redirect::route('6dem.settings');
    }
}

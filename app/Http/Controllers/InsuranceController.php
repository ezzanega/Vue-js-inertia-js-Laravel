<?php

namespace App\Http\Controllers;

use App\Models\Insurance;
use Illuminate\Http\Request;
use App\Models\Enums\InsuranceType;

class InsuranceController extends Controller
{
    //
    public function update(Request $request, $id, $field)
    {
        $insurance = Insurance::where(['id' => $id])->first();

        $request->validate([
            $field =>  'required|string|max:125',
        ]);

        $insurance->update([
            $field => $request->$field,
        ]);
    }

    public function contractual(Request $request)
    {
        $organization = $request->user()->organization;
        $insurance = Insurance::where(['organization_id' => $organization->id, 'type' => InsuranceType::CONTRACTUAL])->first();
        $contractualInsurance = [
            'max_value' => $request->max_value,
            'franchise' => $request->franchise,
            'amount_ht' => $request->amount_ht,
        ];
        $filledContractualInsurance = array_filter($contractualInsurance, function ($value) {
            return $value !== null;
        });
        $insurance->update($filledContractualInsurance);
        return back()->with('contractualStatus', 'settings-updated');
    }

    public function adValorem(Request $request)
    {
        $organization = $request->user()->organization;
        $insurance = Insurance::where(['organization_id' => $organization->id, 'type' => InsuranceType::ADVALOREM])->first();
        $adValoremInsurance = [
            'max_value' => $request->max_value,
            'franchise' => $request->franchise,
            'amount_ht' => $request->amount_ht,
        ];
        $filledAdValoremInsurance = array_filter($adValoremInsurance, function ($value) {
            return $value !== null;
        });
        $insurance->update($filledAdValoremInsurance);
        return back()->with('adValoremStatus', 'settings-updated');
    }
}

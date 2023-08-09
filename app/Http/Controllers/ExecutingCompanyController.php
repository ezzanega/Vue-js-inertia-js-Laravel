<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;
use App\Models\Location;
use App\Models\ExecutingCompany;

class ExecutingCompanyController extends Controller
{
    public function store(Request $request)
    {
        $organization = $request->user()->organization;
        $executingCompany = ExecutingCompany::create([
            'name' => $request->name,
            'siret' => $request->siret,
            'siren' => $request->siren,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'field' => $request->field,
        ]);

        $location = $executingCompany->address()->create([
            'address' => $request->address,
            'city' => $request->city,
            'postal_code' => $request->postalCode,
            'country' => $request->country,
            'full_address' => $request->fullAddress,
            'lat' => $request->lat,
            'lng' => $request->lng,
            'google_map_url' => $request->googleMapUrl,
        ]);

        $location->executingCompany()->associate($executingCompany);
        $location->save();

        $executingCompany->organization()->associate($organization);
        $executingCompany->save();

        return back();
    }

    public function update(Request $request, $id)
    {
        $executingCompagny = ExecutingCompany::where('id', $id)->first();
        $location = Location::where('executing_company_id', $executingCompagny->id)->first();
        $executingData = [
            'name' => $request->name,
            'siret' => $request->siret,
            'siren' => $request->siren,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'field' => $request->field,
        ];
        $locationData = [
            'address' => $request->address,
            'city' => $request->city,
            'postal_code' => $request->postalCode,
            'country' => $request->country,
            'full_address' => $request->fullAddress,
            'lat' => $request->lat,
            'lng' => $request->lng,
            'google_map_url' => $request->googleMapUrl,
        ];
        $filledExecutingData = array_filter($executingData, function ($value) {
            return $value !== null;
        });
        $filledLocationData = array_filter($locationData, function ($value) {
            return $value !== null;
        });

        $location->update($filledLocationData);
        $executingCompagny->update($filledExecutingData);
        return back()->with('status', 'executing-updated');
    }

    public function delete($id)
    {
        $executingCompagny = ExecutingCompany::where(['id' => $id])->first();
        $executingCompagny->delete();

        return Redirect::route('6dem.settings');
    }
}

<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use App\Models\Location;
use App\Models\Organization;
use Illuminate\Http\Request;
use App\Services\TaskProService;

class OrganizationController extends Controller
{

    public function accountSettings(Request $request): Response
    {
        return Inertia::render('6dem/Account', [
            'organization' => Organization::where('id', $request->user()->organization->id)->with('billingAddress')->first(),
            'status' => session('status'),
        ]);
    }


    public function update(Request $request)
    {
        $request->validate([
            'email' => 'required|string|max:255',
            'phoneNumber' => 'required|string|max:255',
            'organizationName' => 'required|string|max:255',
            'siret' => 'required|string|max:255',
            'siren' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
        ]);

        $organization = $request->user()->organization;

        $organization->update([
            'name' => $request->organizationName,
            'phone_number' => $request->phoneNumber,
            'email' => $request->email,
            'siret' => $request->siret,
            'siren' => $request->siren,
            'code_ape' => $request->codeApe,
            'licence' => $request->licence,
            'email' => $request->email,
        ]);

        if (!$organization->billingAddress) {
            $organization->billingAddress()->create([
                'address' => $request->address,
                'city' => $request->city,
                'postal_code' => $request->postalCode,
                'country' => $request->country,
                'full_address' => $request->fullAddress,
                'lat' => $request->lat,
                'lng' => $request->lng,
                'google_map_url' => $request->googleMapUrl,
            ]);
        } else {
            $location =  Location::find($organization->billingAddress->id);
            $location->update([
                'address' => $request->address,
                'city' => $request->city,
                'postal_code' => $request->postalCode,
                'country' => $request->country,
                'full_address' => $request->fullAddress,
                'lat' => $request->lat,
                'lng' => $request->lng,
                'google_map_url' => $request->googleMapUrl,
            ]);
        }

        return back()->with('status', 'organization-updated');
    }

    public function uploadLogo(Request $request, TaskProService $taskProService)
    {
        $organization = $request->user()->organization;
        $request->validate([
            'logo' => 'required|file|mimes:png,jpg,jpeg|max:2048',
        ]);

        $file = $request->file('logo');
        $response = $taskProService->uploadOrganizationLogo($file);

        $path = $response['path'];

        $organization->settings()->updateOrCreate(
            [],
            ['logo' => $path]
        );
        return back();
    }
}

<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Models\Enums\ClientType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class ClientController extends Controller
{

    /**
     * Handle an incoming register request.
     */
    public function store(Request $request): RedirectResponse
    {
        $organization = $request->user()->organization;
        if ($request->clientType === ClientType::PROFETIONAL) {
            $request->validate([
                'clientType' => 'required|string|max:125',
                'clientOrganizationName' => 'required|string|max:125',
                'phoneNumber' => 'required|string|max:125',
                'email' => 'required|string|max:125',
                'address' => 'required|string|max:125',
                'source' => 'required|string|max:125',
            ]);

            $client = Client::create([
                'type' => $request->clientType,
                'phone_number' => $request->phoneNumber,
                'email' => $request->email,
                'address' => $request->address,
                'source' => $request->source,
            ]);

            $client->clientOrganization()->create([
                'name' => $request->clientOrganizationName,
                'siret' => $request->siret,
                'siren' => $request->siren,
            ]);

            $client->organization()->associate($organization);
            $client->save();
        } else {
            $request->validate([
                'clientType' => 'required|string|max:125',
                'firstName' => 'required|string|max:125',
                'lastName' => 'required|string|max:125',
                'phoneNumber' => 'required|string|max:125',
                'email' => 'required|string|max:125',
                'address' => 'required|string|max:125',
                'source' => 'required|string|max:125',
            ]);

            $client = Client::create([
                'type' => $request->clientType,
                'first_name' => $request->firstName,
                'last_name' => $request->lastName,
                'phone_number' => $request->phoneNumber,
                'email' => $request->email,
                'address' => $request->address,
                'source' => $request->source,
            ]);
            $client->organization()->associate($organization);
            $client->save();
        }

        return Redirect::to('/');
    }
}

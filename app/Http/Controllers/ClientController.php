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

    public function index(Request $request): Response
    {
        $organization = $request->user()->organization;
        $clients = Client::where('organization_id', $organization->id)->with('clientOrganization')->get();
        return Inertia::render('6dem/Clients', ['clients' => $clients]);
    }

    /**
     * Handle an incoming register request.
     */
    public function store(Request $request): RedirectResponse
    {
        $organization = $request->user()->organization;
        if ($request->clientType === ClientType::PROFESSIONAL) {
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

    /**
     * Handle an incoming search request.
     */
    public function search(Request $request)
    {
        $search_text = $request->input('search_text');
        $clients = Client::where('organization_id', auth()->user()->organization->id)
            ->where(function ($query) use ($search_text) {
                $query->where('first_name', 'LIKE', "%{$search_text}%")
                    ->orWhere('email', 'LIKE', "%{$search_text}%")
                    ->orWhere('last_name', 'LIKE', "%{$search_text}%")
                    ->orWhereHas('clientOrganization', function ($query) use ($search_text) {
                        $query->where('name', 'LIKE', "%{$search_text}%");
                    });
            })
            ->with('clientOrganization')
            ->take(20)
            ->get();


        return $clients;
    }
}

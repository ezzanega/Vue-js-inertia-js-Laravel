<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use App\Models\Client;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Models\EmailTemplates;
use App\Models\ClientOrganizations;
use App\Models\Enums\ClientType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class ClientController extends Controller
{

    public function index(Request $request): Response
    {
        $organization = $request->user()->organization;
        $clients = Client::where('organization_id', $organization->id)->with('clientOrganization')->get();
        $mails = EmailTemplates::where('organization_id', $organization->id)->get();
        return Inertia::render('6dem/Clients', ['clients' => $clients,'mails'=>$mails]);
    }

    /**
     * Handle an incoming register request.
     */
    public function store(Request $request): RedirectResponse
    {
        $organization = $request->user()->organization;
        if ($request->clientType === ClientType::PROFESSIONAL) {
            $request->validate([
                'clientType' => 'required|string|max:255',
                'clientOrganizationName' => 'required|string|max:255',
                'phoneNumber' => 'required|string|max:255',
                'email' => 'required|string|max:255',
                'address' => 'required|string',
                'city' => 'required|string',
                'country' => 'required|string',
                'source' => 'required|string|max:255',
            ]);

            $client = Client::create([
                'first_name' => $request->firstName,
                'last_name' => $request->lastName,
                'type' => $request->clientType,
                'phone_number' => $request->phoneNumber,
                'email' => $request->email,
                'source' => $request->source,
            ]);

            $location = $client->address()->create([
                'address' => $request->address,
                'city' => $request->city,
                'postal_code' => $request->postalCode,
                'country' => $request->country,
                'full_address' => $request->fullAddress,
                'lat' => $request->lat,
                'lng' => $request->lng,
                'google_map_url' => $request->googleMapUrl,
            ]);

            $clientOrganization = $client->clientOrganization()->create([
                'name' => $request->clientOrganizationName,
                'siret' => $request->siret,
                'siren' => $request->siren,
            ]);

            $location->clientOrganization()->associate($clientOrganization);
            $location->save();

            $client->organization()->associate($organization);
            $client->save();
        } else {
            $request->validate([
                'clientType' => 'required|string|max:255',
                'firstName' => 'required|string|max:255',
                'lastName' => 'required|string|max:255',
                'phoneNumber' => 'required|string|max:255',
                'email' => 'required|string|max:255',
                'address' => 'required|string',
                'city' => 'required|string',
                'country' => 'required|string',
                'source' => 'required|string|max:255',
            ]);

            $client = Client::create([
                'type' => $request->clientType,
                'first_name' => $request->firstName,
                'last_name' => $request->lastName,
                'phone_number' => $request->phoneNumber,
                'email' => $request->email,
                'source' => $request->source,
            ]);

            $client->address()->create([
                'address' => $request->address,
                'city' => $request->city,
                'postal_code' => $request->postalCode,
                'country' => $request->country,
                'full_address' => $request->fullAddress,
                'lat' => $request->lat,
                'lng' => $request->lng,
                'google_map_url' => $request->googleMapUrl,
            ]);
            $client->organization()->associate($organization);
            $client->save();
        }

        return Redirect::route('6dem.clients');
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


    public function deleteClient($id)
    { 
        try {
            $client = Client::find($id);

            if (!$client) {
                return response()->json(['message' => 'Ce client n\'existe pas'], 404);
            }
            if($client->type=="professional")
            {
                $client_organisation = ClientOrganizations::where('client_id', $client->id)->first();

                if (!$client_organisation) {
                    return response()->json(['message' => 'L\'organisation de ce client n\'existe pas'], 404);
                }

                $client_organisation->delete();
            }
            $client->delete();
            return Redirect::route('6dem.clients');
        } catch (\Exception $e) {

            return response()->json(['message' => 'Une erreur s\'est produite lors de la suppression'], 500);
        }
    }

    /**
     * Handle an incoming filter request.
     */
    public function sort(Request $request)
    {
        $last_name = $request->input('last_name') ?? "";
        $email = $request->input('email') ?? "";
        $type = $request->input('type') ?? "";
        $phone_number = $request->input('phone_number') ?? "";
        $source = $request->input('source') ?? "";

        $query = Client::where('organization_id', auth()->user()->organization->id);

        if ($last_name) {
            $query->orderBy('last_name', $last_name);
        }
        if ($email) {
            $query->orderBy('email', $email);
        }
        if ($phone_number) {
            $query->orderBy('phone_number', $phone_number);
        }
        if ($type) {
            $query->orderBy('type', $type);
        }
        if ($source) {
            $query->orderBy('source', $source);
        }
        $clients = $query->get();

        return $clients;
    }

}

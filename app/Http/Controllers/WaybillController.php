<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use App\Models\Waybill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class WaybillController extends Controller
{
    public function preview(Request $request, $id): Response
    {
        $waybill = Waybill::where('id', $id)->with(['movingJob.client', 'movingJob.client.clientOrganization'])->first();
        return Inertia::render('6dem/PreviewWaybill', [
            'waybill' => $waybill,
        ]);
    }

    /**
     * Handle an incoming search request.
     */
    public function search(Request $request)
    {
        $organization = $request->user()->organization;
        $search_text = $request->input('search_text');
        $waybill = Waybill::where('organization_id', $organization->id)
            ->where(function ($query) use ($search_text) {
                $query->where('number', 'LIKE', "%{$search_text}%")
                    ->orWhereHas('movingJob.client', function ($query) use ($search_text) {
                        $query->where('first_name', 'LIKE', "%{$search_text}%")
                            ->orWhere('last_name', 'LIKE', "%{$search_text}%");
                    });
            })
            ->with('movingJob.client')
            ->take(20)
            ->get();

        return $waybill;
    }

    /**
     * Handle an incoming filter request.
     */
    public function sort(Request $request)
    {
        $number = $request->input('number') ?? "";
        $client = $request->input('client') ?? "";
        $date = $request->input('date') ?? "";
        $status = $request->input('status') ?? "";
        $clientType = $request->input('clientType') ?? "";

        $query = Waybill::where('organization_id', auth()->user()->organization->id)->with(['movingJob' => function ($movingJobQuery) use ($date, $client, $clientType) {
            if ($date) {
                $movingJobQuery->orderBy('loading_date', $date);
            }
            $movingJobQuery->with(['client' => function ($clientQuery) use ($client, $clientType) {
                if ($client) {
                    $clientQuery->orderBy('last_name', $client);
                }
                if ($clientType) {
                    $clientQuery->orderBy('type', $clientType);
                }
                $clientQuery->with(['clientOrganization']);
            }]);
        }]);

        if ($number) {
            $query->orderBy('number', $number);
        }
        if ($status) {
            $query->orderBy('status', $status);
        }

        $waybill = $query->get();

        return $waybill;
    }

    public function deleteWaybill($id)
    {
        try {
            $Waybill = Waybill::find($id);

            if (!$Waybill) {
                return response()->json(['message' => 'Cette lettre de voiture n\'existe pas'], 404);
            }
            $Waybill->delete();
            return back()->with('toast', 'La lettre de voiture a été supprimé!');
        } catch (\Exception $e) {

            return response()->json(['message' => 'Une erreur s\'est produite lors de la suppression'], 500);
        }
    }

    public function updateStatutWaybill(Request $request, $id, $field)
    {
        $waybill = Waybill::where('id', $id)->with(['movingJob.client', 'movingJob.client.clientOrganization'])->first();

        $request->validate([
            $field =>  'required|string|max:125',
        ]);

        if ($field === "validity_duratation") {
            $waybill->update([
                $field => $request->$field,
            ]);
        } else if ($field === "status") {
            $waybill->update([
                $field => $request->$field,
            ]);
        }
        return back();
    }
}

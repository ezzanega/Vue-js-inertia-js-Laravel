<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Waybill;

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
        $search_text = $request->input('search_text');
        $waybill = Waybill::where('organization_id', auth()->user()->organization->id)
            ->where(function ($query) use ($search_text) {
                $query->where('number', 'LIKE', "%{$search_text}%");
            })
            ->orWhereHas('movingJob.client', function ($query) use ($search_text) {
                $query->where('first_name', 'LIKE', "%{$search_text}%")
                ->orWhere('last_name', 'LIKE', "%{$search_text}%");
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

        $query = Waybill::with(['movingJob' => function ($movingJobQuery) use ($date, $client, $clientType) {
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
                }]);
        }])
        ->where('organization_id', auth()->user()->organization->id);

        if ($number) {
            $query->orderBy('number', $number);
        }
        if ($status) {
            $query->orderBy('status', $status);
        }

        $waybill = $query->get();

        return $waybill;
    }
}

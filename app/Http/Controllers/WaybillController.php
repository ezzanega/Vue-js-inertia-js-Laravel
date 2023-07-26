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
}

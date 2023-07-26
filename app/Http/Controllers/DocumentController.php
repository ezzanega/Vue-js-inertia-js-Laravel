<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Quotation;
use App\Models\Waybill;
use Inertia\Response;

class DocumentController extends Controller
{
    public function index(Request $request): Response
    {
        $quotations = Quotation::with(['movingJob.client', 'movingJob.client.clientOrganization'])->latest()->get();
        $waybills = Waybill::with(['movingJob.client', 'movingJob.client.clientOrganization'])->latest()->get();

        return Inertia::render('6dem/Documents', [
            'quotations' => $quotations,
            'waybills' => $waybills
        ]);
    }
}

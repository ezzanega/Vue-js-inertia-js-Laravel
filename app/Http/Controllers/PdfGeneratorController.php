<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Quotation;
use Illuminate\Http\Request;

class PdfGeneratorController extends Controller
{

    public function quotation(Request $request, $id)
    {
        $quotation = Quotation::where('id', $id)->with(['movingJob.client', 'movingJob.client.address', 'movingJob.client.clientOrganization'])->first();
        $pdf = PDF::loadView('documents.quotation-v1', [
            'quotation' => $quotation,
            'advisor' => $request->user(),
            'organization' => $request->user()->organization
        ]);
        $filename = 'Devis N°' . $quotation->number;
        return $pdf->stream($filename);
    }
}

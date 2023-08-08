<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Quotation;
use Illuminate\Http\Request;
use App\Models\MovingJobFormula;
use App\Models\MovingJobFormulaOption;

class PdfGeneratorController extends Controller
{

    public function quotation(Request $request, $id)
    {
        $organization = $request->user()->organization;
        $quotation = Quotation::where('id', $id)->with(['movingJob.client', 'movingJob.client.address', 'movingJob.client.clientOrganization'])->first();
        $movingJobFormula = MovingJobFormula::where(['organization_id' => $organization->id, 'slug' => $quotation->movingJob->formula])->first();
        $movingJobFormulaOptionsClientSide = [];
        $movingJobFormulaOptionsOrganizationSide = [];
        if ($movingJobFormula) {
            $movingJobFormulaOptionsClientSide = MovingJobFormulaOption::where(['moving_job_formula_id' => $movingJobFormula->id, 'type' => 'client-side'])->get();
            $movingJobFormulaOptionsOrganizationSide = MovingJobFormulaOption::where(['moving_job_formula_id' => $movingJobFormula->id, 'type' => 'organization-side'])->get();
        }
        $pdf = PDF::loadView('documents.quotation-v1', [
            'quotation' => $quotation,
            'advisor' => $request->user(),
            'movingJobFormula' => [
                "client-side"  => $movingJobFormulaOptionsClientSide,
                "organization-side"   => $movingJobFormulaOptionsOrganizationSide,
            ],
            'organization' => $organization
        ]);
        $filename = 'Devis N°' . $quotation->number . '.pdf';
        return $pdf->stream($filename);
    }
}

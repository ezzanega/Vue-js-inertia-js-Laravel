<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use App\Models\Quotation;
use Illuminate\Http\Request;

class QuotationController extends Controller
{

    public function index(Request $request): Response
    {
        $quotations = Quotation::with('movingJob')->latest()->get();

        return Inertia::render('6dem/Documents', [
            'quotations' => $quotations,
        ]);
    }
}

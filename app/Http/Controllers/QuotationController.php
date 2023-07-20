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

    /**
     * Handle an incoming search request.
     */
    public function search(Request $request)
    {
        $search_text = $request->input('search_text');
        $quotation = Quotation::where('organization_id', auth()->user()->organization->id)
            ->where(function ($query) use ($search_text) {
                $query->where('number', 'LIKE', "%{$search_text}%");
            })
            ->with('movingJob.client')
            ->take(20)
            ->get();
            
        return $quotation;
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdditionalField;
use App\Models\Enums\AdditionalFieldsType;
use App\Models\Enums\Positions;

class AdditionalFieldController extends Controller
{
     /**
     * Handle an incoming register request.
     */
    public function store(Request $request, $id)
    {
        $request->validate([
            'type' => 'required|string|max:125|',
            'position' => 'required|string|max:125|'
        ]);
        
        $additionalField = AdditionalField::create([
            'type' => $request->type,
            'description' => $request->description,
            'position' => $request->position,
        ]);

        switch ($request->position) {
            case Positions::LOADING:
                $additionalField->position = Positions::LOADING;
                break;
            case Positions::SHIPPING:
                $additionalField->position = Positions::SHIPPING;
                break;
            case Positions::HEADER:
                $additionalField->position = Positions::HEADER;
                break;
            default:
                $additionalField->position = Positions::HEADER;
        }

        switch ($request->type) {
            case AdditionalFieldsType::INVOICE:
                $additionalField->invoice_id = $id;
                break;
            case AdditionalFieldsType::WAYBILL:
                $additionalField->waybill_id = $id;
                break;
            case AdditionalFieldsType::QUOTATION:
                $additionalField->quotation_id = $id;
                break;
            default:
                $additionalField->moving_job_id = $id;
        }
        $additionalField->save();
        return $additionalField->id;
    }

    public function update(Request $request, $id, $field)
    {
        $option = AdditionalField::where(['id' => $id])->first();

        $request->validate([
            $field =>  'required|string|max:125',
        ]);

        $option->update([
            $field => $request->$field,
        ]);
    }
}
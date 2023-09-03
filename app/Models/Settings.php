<?php

namespace App\Models;

use App\Models\Organization;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Settings extends Model
{
    use HasFactory;

    protected $fillable = [
        'quotation_validity_duratation',
        'ducuments_general_conditions',
        'ducuments_primary_color',
        'ducuments_secondary_color',
        'calendar_meeting_color',
        'calendar_moving_color',
        'calendar_cartons_delivery_color',
        'calendar_others_color',
        'legal_notice',
        'paiement_process',
        'vat',
        'logo',
        'iban',
        'bic',
    ];

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class, 'organization_id', 'id');
    }
}

<?php

namespace App\Models;

use App\Models\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MovingJob extends Model
{
    use HasFactory;

    protected $fillable = [
        'capacity',
        'formula',
        'volume',
        'loading_address',
        'loading_date',
        'loading_floor',
        'loading_elevator',
        'loading_portaging',
        'loading_details',
        'shipping_address',
        'shipping_date',
        'shipping_floor',
        'shipping_elevator',
        'shipping_portaging',
        'shipping_details',
        'discount_percentage',
        'discount_amount_ht',
        'advance',
        'balance',
    ];

    // public function organization(): BelongsTo
    // {
    //     return $this->belongsTo(Organization::class, 'organization_id', 'id');
    // }
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }
}

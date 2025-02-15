<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'capacity',
        'formula',
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
        'discount_amount',
        'advance',
        'balance',
        'additionnalField_id',
        'option_id',
        'organization_id',
        'client_id'
    ];

    public function additionnalField(): BelongsTo
    {
        return $this->belongsTo(AdditionnalField::class, 'additionnalField_id', 'id');
    }

    public function option(): BelongsTo
    {
        return $this->belongsTo(Option::class, 'option_id', 'id');
    }

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class, 'organization_id', 'id');
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }
}

<?php

namespace App\Models;

use App\Models\Client;
use App\Models\Location;
use App\Models\Quotation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
        'distance',
    ];


    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function quotations(): HasMany
    {
        return $this->hasMany(Quotation::class);
    }

    public function latestQuotation(): HasOne
    {
        return $this->hasOne(Quotation::class)->latestOfMany();
    }

    public function loadingLocation(): HasOne
    {
        return $this->hasOne(Location::class, 'loading_moving_job_id');
    }

    public function shippingLocation(): HasOne
    {
        return $this->hasOne(Location::class, 'shipping_moving_job_id');
    }
}

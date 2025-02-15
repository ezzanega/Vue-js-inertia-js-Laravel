<?php

namespace App\Models;

use App\Models\Client;
use App\Models\Payment;
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
        'discount',
        'discount_amount',
        'amount_ht',
        'amount_ttc',
        'amount_tva',
        'advance',
        'balance',
        'distance',
        'payment_process',
    ];


    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function quotations(): HasMany
    {
        return $this->hasMany(Quotation::class);
    }

    public function options(): HasMany
    {
        return $this->hasMany(Option::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
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

    public function getAdvanceOrBalance($type)
    {
        $parts = explode('-', $this->payment_process);
        $advance = isset($parts[0]) ? (float) $parts[0] : 0;
        $balance = isset($parts[1]) ? (float) $parts[1] : 0;

        if ($type === 'advance') {
            return $advance ? $advance : 0;
        } elseif ($type === 'balance') {
            return $balance ? $balance : 0;
        } else {
            return null;
        }
    }

    public function updateMovingJobPrice($tva)
    {
        $options = $this->options()->get();
        $total = 0;
        foreach ($options as $option) {
            $total += floatval($option->total_price_ht);
        }
        $totalHT = floatval($this->discount) > 0 ? $total - floatval($this->calculatePercentage($total, floatval($this->discount))) : $total;
        $amountTVA = floatval($this->calculatePercentage(floatval($totalHT), floatval($tva)));
        $amountTTC = number_format(floatval($totalHT) + floatval($amountTVA), 2, '.', '');
        $this->amount_ht = $totalHT;
        $this->amount_tva = $amountTVA;
        $this->amount_ttc = $amountTTC;
        $this->advance = $this->calculatePercentage($amountTTC, floatval($this->getAdvanceOrBalance('advance')));
        $this->balance = $this->calculatePercentage($amountTTC, floatval($this->getAdvanceOrBalance('balance')));
        return $this->save();
    }

    public function calculatePercentage($amount, $percentage)
    {
        return number_format((floatval($amount) * floatval($percentage)) / 100, 2, '.', '');
    }
}

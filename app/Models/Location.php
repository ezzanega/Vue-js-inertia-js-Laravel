<?php

namespace App\Models;

use App\Models\Client;
use App\Models\MovingJob;
use App\Models\Organization;
use App\Models\ExecutingCompany;
use App\Models\ClientOrganizations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'city',
        'postal_code',
        'country',
        'full_address',
        'lat',
        'lng',
        'google_map_url',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class, 'organization_id', 'id');
    }

    public function clientOrganization(): BelongsTo
    {
        return $this->belongsTo(ClientOrganizations::class, 'client_organization_id', 'id');
    }

    public function executingCompany(): BelongsTo
    {
        return $this->belongsTo(ExecutingCompany::class, 'executing_company_id', 'id');
    }

    public function loadingMovingJob(): BelongsTo
    {
        return $this->belongsTo(MovingJob::class, 'loading_moving_job_id', 'id');
    }

    public function shippingMovingJob(): BelongsTo
    {
        return $this->belongsTo(MovingJob::class, 'shipping_moving_job_id', 'id');
    }
}

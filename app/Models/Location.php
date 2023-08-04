<?php

namespace App\Models;

use App\Models\Client;
use App\Models\Organization;
use App\Models\ClientOrganizations;
use App\Models\ExecutingCompany;
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

    public function executinCompany(): BelongsTo
    {
        return $this->belongsTo(ExecutingCompany::class, 'executing_company_id', 'id');
    }
}

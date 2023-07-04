<?php

namespace App\Models;

use App\Models\MovingJob;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type',
        'last_name',
        'first_name',
        'phone_number',
        'email',
        'address',
        'source'
    ];

    public function movingJobs(): HasMany
    {
        return $this->hasMany(MovingJob::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;

    protected $fillable = [
        'formula',
        'quotation_id',
        'advisor',
        'advisor_phone_number',
        'document_id',
        'validity',
    ];

}

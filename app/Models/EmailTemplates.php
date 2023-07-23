<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailTemplates extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'subject',
        'type',
        'body',
        'parameters',
    ];
}

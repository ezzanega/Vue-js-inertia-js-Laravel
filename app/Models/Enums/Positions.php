<?php

namespace App\Models\Enums;

class Positions
{
    use HasEnums;

    const LOADING = 'loading';
    const SHIPPING = 'shipping';
    const HEADER = 'header';
}

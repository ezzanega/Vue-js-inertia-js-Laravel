<?php

namespace App\Models\Enums;

class OptionType
{
    use HasEnums;

    const ELEVATOR = 'elevator-option';
    const PIANO = 'piano-option';
    const WAREHOUSE = 'warehouse-option';
    const OTHER = 'other-option';
}

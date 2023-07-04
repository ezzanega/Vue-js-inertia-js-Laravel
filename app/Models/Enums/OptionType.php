<?php

namespace App\Models\Enums;

class OptionType
{
    use HasEnums;

    const INVOICE = 'invoice-option';
    const QUOTATION = 'quotation-option';
    const WAYBILLS = 'waybills-option';
}

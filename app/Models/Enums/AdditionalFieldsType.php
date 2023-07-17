<?php

namespace App\Models\Enums;

class AdditionalFieldsType
{
    use HasEnums;

    const QUOTATION = 'quotation-field';
    const INVOICE = 'invoice-field';
    const WAYBILL = 'waybill-field';
    const MOVINGJOB = 'movingjob-field';
}

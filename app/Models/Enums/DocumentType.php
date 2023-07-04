<?php

namespace App\Models\Enums;

class DocumentType
{
    use HasEnums;

    const INVOICE = 'invoice';
    const QUOTATION = 'quotation';
    const WAYBILLS = 'waybills';
}

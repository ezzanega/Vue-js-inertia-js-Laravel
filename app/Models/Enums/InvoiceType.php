<?php

namespace App\Models\Enums;

class InvoiceType
{
    use HasEnums;

    const SOLDE = 'balance';
    const ACOMPTE = 'advance';
}

<?php

namespace App\Models\Enums;

class InvoiceStatus
{
    use HasEnums;

    const ONHOLD = 'A payer';
    const LATE = 'Retard';
    const NOTFULLYPAID = 'Partiellement payé';
    const PAID = 'Payé';
    const CANCELLED = 'Annulé';
}

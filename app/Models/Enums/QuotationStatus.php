<?php

namespace App\Models\Enums;

class QuotationStatus
{
    use HasEnums;

    const SENT = 'Envoyé';
    const ACCEPTED = 'Accepté';
    const DENIED = 'Refusé';
    const EXPIRED = 'Expiré';
    const SIGNED = 'Signé';
    const NOTSIGNED = 'Non signé';
}

<?php

namespace App\Models\Enums;

class WaybillStatus
{
    use HasEnums;

    const SIGNED = 'Signé';
    const NOTSIGNED = 'Non signé';
}

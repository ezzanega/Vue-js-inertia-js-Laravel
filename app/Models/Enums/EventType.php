<?php

namespace App\Models\Enums;

class EventType
{
    use HasEnums;

    const MOVING = 'moving';
    const MEETING = 'meeting';
    const CARTONS = 'cartons-delivery';
    const OTHERS = 'others';
}

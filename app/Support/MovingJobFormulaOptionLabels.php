<?php

namespace App\Support;

class MovingJobFormulaOptionType
{
    protected static array $settingsLabels = [
        'organization-side' => 'À notre charge',
        'client-side' => 'À la charge du client',
    ];

    protected static array $documentsLabels = [
        'organization-side' => 'À notre charge',
        'client-side' => 'À votre charge',
    ];

    public static function getSettingsLabel(?string $name = null): array
    {
        return static::$settingsLabels[$name];
    }

    public static function settingsLabels(): array
    {
        return static::$settingsLabels;
    }

    public static function getDocumentsLabel(?string $name = null): array
    {
        return static::$documentsLabels[$name];
    }

    public static function documentsLabels(): array
    {
        return static::$documentsLabels;
    }
}

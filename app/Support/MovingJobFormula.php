<?php

namespace App\Support;

use App\Models\Enums\ProjectCategoryType;


class MovingJobFormula
{

    protected static array $formulas = [
        'Standard' => [
            'organization-side' => [
                'Démontage remontage des meubles',
                'Emballage déballage objets fragiles',
                'Protection du mobilier par couvertures',
                'Chargement déchargement mobilier',
                'Fournitures du matériel d’emballage',
                'Mise sous housses de la literie',
                'Autorisations de stationnement',
                'Placement des meubles dans les pièces de votre choix',
            ],
            'client-side' => [
                'Emballage objets non fragiles',
                'Décrochage objets fixés aux murs',
                'Débranchement électroménager',
            ]
        ],
        'Économique' => [
            'organization-side' => [
                'Protection du mobilier par couvertures',
                'Chargement déchargement mobilier',
                'Fournitures du matériel d’emballage',
                'Mise sous housses de la literie',
                'Autorisations de stationnement',
                'Placement des meubles dans les pièces de votre choix',
            ],
            'client-side' => [
                'Démontage remontage des meubles',
                'Emballage déballage objets fragiles',
                'Emballage objets non fragiles',
                'Décrochage objets fixés aux murs',
                'Débranchement électroménager',
            ]
        ],
        'Économique plus' => [
            'organization-side' => [
                'Démontage remontage des meubles',
                'Protection du mobilier par couvertures',
                'Chargement déchargement mobilier',
                'Fournitures du matériel d’emballage',
                'Mise sous housses de la literie',
                'Autorisations de stationnement',
                'Placement des meubles dans les pièces de votre choix',
            ],
            'client-side' => [
                'Emballage déballage objets fragiles',
                'Emballage objets non fragiles',
                'Décrochage objets fixés aux murs',
                'Débranchement électroménager',
            ]
        ],
        'Confort' => [
            'organization-side' => [
                'Démontage remontage des meubles',
                'Emballage déballage objets fragiles et non fragiles',
                'Protection du mobilier par couvertures',
                'Chargement déchargement mobilier',
                'Fournitures du matériel d’emballage',
                'Mise sous housses de la literie',
                'Autorisations de stationnement',
                'Placement des meubles dans les pièces de votre choix',
            ],
            'client-side' => [
                'Emballage objets non fragiles',
                'Décrochage objets fixés aux murs',
                'Débranchement électroménager',
            ]
        ],
    ];

    public static function getFormula(?string $name = null): string
    {
        return static::$formulas[$name];
    }

    public static function all(): array
    {
        return static::$formulas;
    }
}

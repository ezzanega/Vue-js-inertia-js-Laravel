<?php

namespace App\Observers;

use Illuminate\Support\Str;
use App\Models\Organization;
use App\Support\MovingJobFormula;

class OrganizationObserver
{

    public function creating(Organization $movingjob): void
    {
        $movingjob->uuid = Str::uuid();
    }

    public function created(Organization $organization): void
    {
        $organization->addRole('admin');
        $organization->addRole('sales');
        $organization->addRole('operator');
        $organization->addRole('lead-operator');

        $organization->settings()->create([
            "quotation_validity_duratation" => "",
            "ducuments_general_conditions" => "",
            "ducuments_primary_color" => "rgb(240, 240, 240)",
            "ducuments_secondary_color" => "",
            "legal_notice" => "",
            "vat" => "20"
        ]);

        foreach (MovingJobFormula::all() as $key => $formula) {
            $movingJobFormula = $organization->movingJobFormulas()->create([
                "name" => $key,
                "slug" => Str::slug($key)
            ]);
            foreach ($formula['organization-side'] as $item) {
                $movingJobFormula->options()->create([
                    'type' => 'organization-side',
                    'text' => $item,
                ]);
            }

            foreach ($formula['client-side'] as $item) {
                $movingJobFormula->options()->create([
                    'type' => 'client-side',
                    'text' => $item,
                ]);
            }
        }
    }
}

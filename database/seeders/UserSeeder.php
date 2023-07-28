<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Client;
use App\Models\Insurance;
use Illuminate\Support\Str;
use App\Models\Organization;
use Illuminate\Database\Seeder;
use App\Models\Enums\ClientType;
use App\Support\MovingJobFormula;
use App\Models\Enums\InsuranceType;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    // Sources Options
    // Internet
    // Marketing par mail
    // Hors ligne (Bouche à oreil)
    // Recherche organique
    // Recherche payante
    // Références
    // Réseaux sociaux
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'first_name' => 'Jhon',
            'last_name' => 'Doe',
            'phone_number' => '06XXXXXX01',
            'email' => 'jhon.doe@6dem.com',
            'password' => Hash::make('6dem01')
        ]);

        $organization = Organization::create([
            'name' => '6dem SAS',
            'email' => $user->email,
            'phone_number' => $user->phone_number,
            'owner_id' => $user->id
        ]);

        $user->assignRole('admin');

        $organization->billingAddress()->create([
            "address" => "1 Rue Jean Jaurès",
            "city" => "Annecy",
            "postal_code" => "74000",
            "country" => "France",
            "full_address" => "1 Rue Jean Jaurès, 74000 Annecy, France",
            'lat' => '',
            'lng' => '',
            "google_map_url" => "https://maps.google.com/?q=1+Rue+Jean+Jaur%C3%A8s,+74000+Annecy,+France&ftid=0x478b8ff09da5c881:0x68fea6b028d4e264"
        ]);

        $organization->settings()->create([
            "quotation_validity_duratation" => "",
            "ducuments_general_conditions" => "",
            "ducuments_primary_color" => "",
            "ducuments_secondary_color" => "",
            "legal_notice" => "",
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

        $client = Client::create([
            'type' => ClientType::INDIVIDUAL,
            'first_name' => 'James',
            'last_name' => 'Doe',
            'phone_number' => '00000000',
            'email' => 'jamesdoe@gmail.com',
            'source' => 'From my auntie',
        ]);

        $location = $client->address()->create([
            "address" => "1 Rue Jean Jaurès",
            "city" => "Annecy",
            "postal_code" => "74000",
            "country" => "France",
            "full_address" => "1 Rue Jean Jaurès, 74000 Annecy, France",
            'lat' => '',
            'lng' => '',
            "google_map_url" => "https://maps.google.com/?q=1+Rue+Jean+Jaur%C3%A8s,+74000+Annecy,+France&ftid=0x478b8ff09da5c881:0x68fea6b028d4e264"
        ]);

        $insurance = Insurance::create([
            'type' => InsuranceType::ADVALOREM,
            'max_value' => "",
            'franchise' => "",
            'amount_ht' => "",
            'organization_id' => $organization->id
        ]);

        $insurance = Insurance::create([
            'type' => InsuranceType::CONTRACTUAL,
            'max_value' => "",
            'franchise' => "",
            'amount_ht' => "",
            'organization_id' => $organization->id
        ]);

        $client->organization()->associate($organization);
        $client->save();

        $user->organization()->associate($organization);
        $user->save();
    }
}

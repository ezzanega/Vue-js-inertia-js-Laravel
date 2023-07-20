<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Organization;
use App\Models\Client;
use App\Models\Enums\ClientType;
use App\Models\Insurance;
use App\Models\Enums\InsuranceType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
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
            'owner_id' => $user->id
        ]);

        $client = Client::create([
            'type' => ClientType::INDIVIDUAL,
            'first_name' => 'James',
            'last_name' => 'Doe',
            'phone_number' => '00000000',
            'email' => 'jamesdoe@gmail.com',
            'address' => 'Nowhere to be found',
            'source' => 'From my auntie',
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

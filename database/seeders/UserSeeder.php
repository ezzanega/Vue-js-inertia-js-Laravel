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
use App\Services\TaskProService;
use App\Support\MovingJobFormula;
use App\Models\Enums\InsuranceType;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(TaskProService $taskProService): void
    {
        $taskProResponse = $taskProService->login('jhon.doe@6dem.com', '6dem01');
        if (!array_key_exists('token', $taskProResponse)) {
            $taskProResponse = $taskProService->register('Jhon', 'Doe', 'jhon.doe@6dem.com', '6dem01');
        }
        $user = User::create([
            'taskpro_user_id' => $taskProResponse["_id"],
            'taskpro_token' => $taskProResponse["token"],
            'first_name' => 'Jhon',
            'last_name' => 'Doe',
            'phone_number' => '06XXXXXX01',
            'email' => 'jhon.doe@6dem.com',
            'password' => Hash::make('6dem01')
        ]);

        $taskProOrganizationResponse = $taskProService->createOrganization('Sysdem SAS', $user);
        $organization = Organization::create([
            'taskpro_organization_id' => $taskProOrganizationResponse["_id"],
            'name' => 'Sysdem SAS',
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
            'lat' => '45.901934',
            'lng' => '6.128088300000001',
            "google_map_url" => "https://maps.google.com/?q=1+Rue+Jean+Jaur%C3%A8s,+74000+Annecy,+France&ftid=0x478b8ff09da5c881:0x68fea6b028d4e264"
        ]);

        $client = Client::create([
            'type' => ClientType::INDIVIDUAL,
            'first_name' => 'James',
            'last_name' => 'Doe',
            'phone_number' => '00000000',
            'email' => 'jamesdoe@gmail.com',
            'source' => 'Appel entant',
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


//**********************Deuxième utilisateur******************************** */


        $taskProResponse = $taskProService->login('ezzanega@gmail.com', '123456');
        if (!array_key_exists('token', $taskProResponse)) {
            $taskProResponse = $taskProService->register('Jhon', 'Doe', 'ezzanega@gmail.com', '123456');
        }
        $user2 = User::create([
            'taskpro_user_id' => $taskProResponse["_id"],
            'taskpro_token' => $taskProResponse["token"],
            'first_name' => 'ezzanega',
            'last_name' => 'bouchra',
            'phone_number' => '06XXXXXX02',
            'email' => 'ezzanega@gmail.com',
            'password' => Hash::make('123456')
        ]);

        $taskProOrganizationResponse = $taskProService->createOrganization('Deuxième organisation', $user2);
        $organization2 = Organization::create([
            'taskpro_organization_id' => $taskProOrganizationResponse["_id"],
            'name' => 'Deuxième organisation',
            'email' => $user2->email,
            'phone_number' => $user2->phone_number,
            'owner_id' => $user2->id
        ]);

        $user2->assignRole('lead-operator');


        $organization->billingAddress()->create([
            "address" => "1 Rue Jean Jaurès",
            "city" => "Annecy",
            "postal_code" => "74000",
            "country" => "France",
            "full_address" => "1 Rue Jean Jaurès, 74000 Annecy, France",
            'lat' => '45.901934',
            'lng' => '6.128088300000001',
            "google_map_url" => "https://maps.google.com/?q=1+Rue+Jean+Jaur%C3%A8s,+74000+Annecy,+France&ftid=0x478b8ff09da5c881:0x68fea6b028d4e264"
        ]);

        $client2 = Client::create([
            'type' => ClientType::INDIVIDUAL,
            'first_name' => 'James',
            'last_name' => 'Doe',
            'phone_number' => '00000000',
            'email' => 'ezzanega@gmail.com',
            'source' => 'Appel entant',
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

        $client2->organization()->associate($organization);
        $client2->save();

        $user2->organization()->associate($organization);
        $user2->save();
    }
}

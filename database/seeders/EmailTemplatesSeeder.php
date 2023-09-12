<?php

namespace Database\Seeders;

use App\Models\EmailTemplates;
use App\Models\Enums\MailType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EmailTemplatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EmailTemplates::create([
            'name' => 'Welcome email',
            'type' => MailType::GENERIC,
            'subject' => 'Confirmation de ton inscription sur le CRM Sysdem ✅',
            'body' => 'Hello, [firstName] <br/> Ton inscription a bien été prise en compte.<br/> nous te remercions pour ta confiance.',
            'parameters' => json_encode([
                'first_name' => '[firstName]',
                'last_name' => '[lastName]',
                'email' => '[email]',
                'full_name' => '[fullName]',
                'phone_number' => '[phoneNumber]',
            ])
        ]);


        EmailTemplates::create([
            'name' => 'Invitation email',
            'type' => MailType::GENERIC,
            'subject' => '[fromName] de [organizationName] vous invite à rejoindre le CRM Sysdem',
            'body' => 'Hello,<br/> [fromName] de [organizationName] vous a invité à rejoindre son équipe.<br/>Pour commencer, il vous suffit de <a href="[invitationLink]" target="_blank">cliquer ici</a> pour créer votre compte',
            'parameters' => json_encode([
                'invitation_link' => '[invitationLink]',
                'from_name' => '[fromName]',
                'organization' => '[organizationName]',
            ])
        ]);


        EmailTemplates::create([
            'name' => 'Invitation email',
            'type' => MailType::GENERIC,
            'subject' => '[organizationName] vient de vous envoyer un document',
            'body' => 'Bonjour [clientName], <br/> Vous trouverez en pièce jointe le devis',
            'parameters' => json_encode([
                'client_name' => '[clientName]',
                'organization' => '[organizationName]',
            ])
        ]);
    }
}

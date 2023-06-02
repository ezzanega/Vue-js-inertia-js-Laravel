<?php

namespace Database\Seeders;

use App\Models\EmailTemplates;
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
            'type' => '',
            'subject' => 'Confirmation de ton inscription sur le CRM 6dem ✅',
            'message' => 'Hello, [fistName] <br/> Ton inscription a bien été prise en compte.<br/> nous te remercions pour ta confiance.',
        ]);
    }
}

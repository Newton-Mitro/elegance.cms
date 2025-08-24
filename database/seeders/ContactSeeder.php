<?php

namespace Database\Seeders;

use App\Infrastructure\Models\Contact;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    public function run(): void
    {
        Contact::factory(5)->create(); // generate 5 contacts
    }
}

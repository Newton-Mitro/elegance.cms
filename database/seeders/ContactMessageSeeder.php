<?php

namespace Database\Seeders;

use App\Infrastructure\Models\ContactMessage;
use Illuminate\Database\Seeder;

class ContactMessageSeeder extends Seeder
{
    public function run(): void
    {
        ContactMessage::factory(15)->create();
    }
}

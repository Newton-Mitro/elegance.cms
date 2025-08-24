<?php

namespace Database\Seeders;

use App\Infrastructure\Models\Notice;
use Illuminate\Database\Seeder;

class NoticeSeeder extends Seeder
{
    public function run(): void
    {
        Notice::factory(12)->create();
    }
}

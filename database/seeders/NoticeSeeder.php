<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Notice;

class NoticeSeeder extends Seeder
{
    public function run(): void
    {
        Notice::factory(12)->create(); // generate 12 notices
    }
}

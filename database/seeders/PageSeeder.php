<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            'About',
            'Mission',
            'Vision',
            'Disclaimer',
            'Privacy Policy',
            'Founder Message',
            'Leaders Message',
        ];

        $now = Carbon::now();

        foreach ($pages as $title) {
            DB::table('pages')->insert([
                'title' => $title,
                'slug' => Str::slug($title),
                'meta_title' => $title,
                'meta_description' => $title . ' page description.',
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}

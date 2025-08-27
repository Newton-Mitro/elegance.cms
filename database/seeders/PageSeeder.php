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
            'Our Story',
            'Our Mission',
            'Our Vision',
            'Our Values',
            'Our Journey',
            'Our Culture',
            'Founder Message',
            'Leaders Message',
            'Disclaimer',
            'Terms of Service',
            'Privacy Policy',
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

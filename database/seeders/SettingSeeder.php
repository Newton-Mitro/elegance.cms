<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    public function run()
    {
        $settings = [
            // Basic site info
            ['key' => 'site_name', 'value' => 'My Awesome CMS'],
            ['key' => 'site_email', 'value' => 'info@example.com'],
            ['key' => 'site_logo', 'value' => '/storage/logo.png'],
            ['key' => 'site_favicon', 'value' => '/storage/favicon.ico'],
            ['key' => 'default_language', 'value' => 'en'],
            ['key' => 'timezone', 'value' => 'UTC'],
            ['key' => 'maintenance_mode', 'value' => '0'],

            // SEO
            ['key' => 'meta_title', 'value' => 'Welcome to My CMS'],
            ['key' => 'meta_description', 'value' => 'A powerful CMS built with Laravel'],

            // Social links (JSON)
            ['key' => 'facebook', 'value' => 'https://facebook.com/yourpage'],
            ['key' => 'twitter', 'value' => 'https://twitter.com/yourpage'],
            ['key' => 'instagram', 'value' => 'https://instagram.com/yourpage'],
            ['key' => 'linkedin', 'value' => 'https://linkedin.com/yourpage'],
            ['key' => 'youtube', 'value' => 'https://youtube.com/yourpage'],
            ['key' => 'github', 'value' => 'https://github.com/yourpage'],
            ['key' => 'discord', 'value' => 'https://discord.com/yourpage'],

            // Contact info
            ['key' => 'contact_address', 'value' => '123 Main Street, City, Country'],
            ['key' => 'contact_phone', 'value' => '+1234567890'],
            ['key' => 'contact_email', 'value' => 'contact@example.com'],
            ['key' => 'contact_map_embed', 'value' => '<iframe src="..."></iframe>'],
        ];

        foreach ($settings as $setting) {
            DB::table('settings')->updateOrInsert(
                ['key' => $setting['key']],
                ['value' => $setting['value'], 'created_at' => now(), 'updated_at' => now()]
            );
        }
    }
}

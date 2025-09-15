<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            ['key' => 'name', 'value' => 'CRM'],
            ['key' => 'phone', 'value' => '00000000'],
            ['key' => 'mail_host', 'value' => 'mail.dominio.com'],
            ['key' => 'mail_port', 'value' => '465'],
            ['key' => 'mail_username', 'value' => 'user@dominio.com'],
            ['key' => 'mail_password', 'value' => 'password'],
            ['key' => 'mail_encryption', 'value' => 'ssl'],
            ['key' => 'logo', 'value' => ''],
        ];

        foreach ($settings as $setting) {
            Setting::firstOrCreate(['key' => $setting['key']], $setting);
        }
    }
}

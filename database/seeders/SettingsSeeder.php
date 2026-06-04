<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['key' => 'company_name', 'value' => 'My Perfect Stitch', 'type' => 'string', 'group' => 'general'],
            ['key' => 'company_address', 'value' => '25 Parliament Road, Olympia, Lusaka, Zambia', 'type' => 'string', 'group' => 'general'],
            ['key' => 'company_phone', 'value' => '+260 968 531 630', 'type' => 'string', 'group' => 'general'],
            ['key' => 'company_email', 'value' => 'info@myperfectstitch.co.zm', 'type' => 'string', 'group' => 'general'],
            ['key' => 'currency', 'value' => 'ZMW', 'type' => 'string', 'group' => 'general'],
            ['key' => 'timezone', 'value' => 'Africa/Lusaka', 'type' => 'string', 'group' => 'general'],
            ['key' => 'vat_rate', 'value' => '16', 'type' => 'integer', 'group' => 'invoicing'],
            ['key' => 'invoice_prefix', 'value' => 'MPS-INV', 'type' => 'string', 'group' => 'invoicing'],
            ['key' => 'order_prefix', 'value' => 'MPS-ORD', 'type' => 'string', 'group' => 'invoicing'],
            ['key' => 'project_prefix', 'value' => 'MPS-PRJ', 'type' => 'string', 'group' => 'invoicing'],
            ['key' => 'napsa_rate', 'value' => '5', 'type' => 'integer', 'group' => 'hr'],
            ['key' => 'nhima_rate', 'value' => '1', 'type' => 'integer', 'group' => 'hr'],
            ['key' => 'whatsapp_number', 'value' => '260968531630', 'type' => 'string', 'group' => 'general'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}

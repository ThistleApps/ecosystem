<?php

use Illuminate\Database\Seeder;

class AdminSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\AdminSetting::query()->truncate();

        \App\Models\AdminSetting::query()->create([
            'key' => 'Default MySQL UN',
            'Scope' => 'Merchant DB',
            'description' => 'Default Merchant DB User Name',
            'slug' => \App\Models\AdminSetting::DEF_DB_UN
        ]);

        \App\Models\AdminSetting::query()->create([
            'key' => 'Default MySQL PW',
            'Scope' => 'Merchant DB',
            'description' => 'Default Merchant DB Password',
            'slug' => \App\Models\AdminSetting::DEF_DB_PW
        ]);

        \App\Models\AdminSetting::query()->create([
            'key' => 'Default MySQL DB Name',
            'Scope' => 'Merchant DB',
            'description' => 'Default Merchant DB Name',
            'slug' => \App\Models\AdminSetting::DEF_DB_NAME
        ]);

        \App\Models\AdminSetting::query()->create([
            'key' => 'Stripe Public key',
            'Scope' => 'Stripe Api key',
            'description' => 'stripe Live api key for Real transactions',
            'slug' => 'stripe_pub'
        ]);

        \App\Models\AdminSetting::query()->create([
            'key' => 'Stripe Secret Key',
            'Scope' => 'Stripe Api key',
            'description' => 'stripe Live api key for Real transactions',
            'slug' => 'stripe_sec'
        ]);

    }
}

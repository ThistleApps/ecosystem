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
            'key' => 'Stripe Test',
            'Scope' => 'Test Api key',
            'description' => 'stripe test api key just for test transactions',
            'slug' => 'stripe_test'
        ]);

        \App\Models\AdminSetting::query()->create([
            'key' => 'Stripe Live',
            'Scope' => 'Live Api key',
            'description' => 'stripe Live api key for Real transactions',
            'slug' => 'stripe_live'
        ]);

    }
}

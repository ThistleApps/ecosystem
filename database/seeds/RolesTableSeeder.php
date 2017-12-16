<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('roles')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        \App\Role::query()->create([
            'name' => 'Admin',
            'description' => 'Admin has access of all system'
        ]);

        \App\Role::query()->create([
            'name' => 'Merchant',
            'description' => 'Merchant has access of merchant level system'
        ]);

        $this->call(UserRoleTableSeeder::class);
    }
}

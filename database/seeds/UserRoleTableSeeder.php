<?php

use Illuminate\Database\Seeder;

class UserRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('role_user')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $user = \App\User::query()->first();

        $user->roles()->sync(['1']);
    }
}

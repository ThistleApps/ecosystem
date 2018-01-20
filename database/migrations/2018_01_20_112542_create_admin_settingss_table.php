<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminSettingssTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key' , '50');
            $table->text('value')->nullable();
            $table->string('description')->nullable();
            $table->string('scope' , '50')->nullable();
            $table->string('slug' , '50')->nullable();
            $table->timestamps();
        });

        (new AdminSettingsTableSeeder())->run();
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_settings');
    }
}

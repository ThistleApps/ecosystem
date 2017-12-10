<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProfileRelatedInfoInUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('business_name')->nullable();
            $table->string('primary_affiliate')->nullable();
            $table->string('primary_affiliate_number')->nullable();
            $table->string('pos_type')->nullable();
            $table->string('pos_wan_address')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->dropColumn('business_name');
            $table->dropColumn('primary_affiliate');
            $table->dropColumn('primary_affiliate_number');
            $table->dropColumn('pos_type');
            $table->dropColumn('pos_wan_address');
        });
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_information', function (Blueprint $table) {
            $table->increments('id');
            $table->char('store_number');
            $table->integer('user_id')->index()->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('long_name' , 50);
            $table->string('addr_line1' , 32);
            $table->string('addr_line2' , 32);
            $table->string('addr_line3' , 32);
            $table->string('zone' , 1);
            $table->string('area_code' , 3);
            $table->string('number' , 7);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('store_information');
    }

}

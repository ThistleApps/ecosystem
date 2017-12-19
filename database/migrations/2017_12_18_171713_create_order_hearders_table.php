<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderHeardersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_headers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index()->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->char('store_number' , 2);
            $table->integer('job_number')->index()->nullable();
            $table->integer('order_number')->index()->nullable();
            $table->string('customer_name' , 30)->nullable();
            $table->char('customer_number' , 8)->nullable();
            $table->string('ship_to_name' , 30)->nullable();
            $table->string('ship_to_addr_1' , 30)->nullable();
            $table->string('ship_to_addr_2' , 30)->nullable();
            $table->string('ship_to_addr_3' , 30)->nullable();
            $table->string('ship_to_email_address' , 80)->nullable();
            $table->string('cell_phone_for_texting' , 11)->nullable();
            $table->string('area_code' , 4)->nullable();
            $table->string('phone_no' , 8)->nullable();
            $table->string('special_line_1' , 30)->nullable();
            $table->string('special_line_2' , 30)->nullable();
            $table->string('reference' , 30)->nullable();
            $table->date('creation_date')->nullable();
            $table->date('delivery_date')->nullable();
            $table->date('expiration_date')->nullable();
            $table->char('salesperson_id')->nullable();
            $table->char('clerk' , 10)->nullable();
            $table->char('transaction_code_1' , 1)->nullable();
            $table->char('transaction_code_2' , 1)->nullable();
            $table->char('transaction_code_3' , 1)->nullable();
            $table->char('transaction_code_4' , 1)->nullable();
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
        Schema::dropIfExists('order_headers');
    }
}

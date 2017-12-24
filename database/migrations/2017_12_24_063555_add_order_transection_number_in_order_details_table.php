<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOrderTransectionNumberInOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_details', function (Blueprint $table) {
            $table->integer('transaction_number');
            $table->foreign('transaction_number')->references('order_number')->on('order_headers')->onDelete('cascade');
            $table->integer('ref_no');
            $table->string('sku_number' , 20)->nullable()->change();
            $table->date('delivery_date')->nullable()->change();
            $table->string('selling_u_m' , 2)->nullable()->change();
            $table->float('qty_selling_units' )->nullable()->change();
            $table->string('item' , 14)->nullable()->change();
            $table->string('description' , 32)->nullable()->change();
            $table->float('cust_price')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_details', function (Blueprint $table) {
            $table->dropForeign('transaction_number');
            $table->dropColumn('transaction_number');
            $table->dropColumn('ref_no');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OrderActivityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_activity', function (Blueprint $table) {
            $table->increments('id_order');
            $table->integer('id_mgt_item')->references('id_mgt_item')->on('management_item');
            $table->integer('id_penyetor')->references('id_user')->on('users');
            $table->integer('id_bank_sampah')->references('id_user')->on('users');
            $table->dateTime('date_order');
            $table->string('distance',100);
            $table->string('vehicle',100)->nullable();
            $table->string('description',100)->nullable();
            $table->string('status',100)->default('0');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_activity');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ManagementItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('management_item', function (Blueprint $table) {
            $table->increments('id_mgt_item');
            $table->integer('id_penyetor')->references('id_user')->on('users');
            $table->integer('id_type_item')->references('id_type_item')->on('price_list');
            $table->string('description_item',100);
            $table->integer('estimate_weight');
            $table->integer('fixed_weight')->default('0');
            $table->longText('capture_image');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('management_item');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name','100');
            $table->string('email')->unique();
            $table->string('no_hp',15);
            $table->string('alamat',100);
            $table->string('provinsi',100);
            $table->string('kota',100);
            $table->string('kecamatan');
            $table->string('kelurahan');
            $table->string('role');
            $table->string('lat')->nullable();
            $table->string('long')->nullable();
            $table->string('operational_time')->nullable();
            $table->integer('accumulation_reward')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->text('profile_photo_path')->nullable();
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
        Schema::dropIfExists('users');
    }
}

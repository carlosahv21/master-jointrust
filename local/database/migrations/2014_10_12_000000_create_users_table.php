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
            $table->increments('id')->unique();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('neighborhood')->nullable();
            $table->string('location')->nullable();
            $table->string('role')->nullable();
            $table->string('password')->nullable();
            $table->string('user_image')->nullable();
            $table->string('identificacion')->nullable();
            $table->string('enrollment')->nullable();
            $table->string('email_verified_at')->nullable();
            $table->string('confirm')->nullable();
            $table->string('method')->nullable();
            $table->string('advertisement')->nullable();
            $table->string('first_time')->nullable();
            $table->rememberToken()->unique();
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

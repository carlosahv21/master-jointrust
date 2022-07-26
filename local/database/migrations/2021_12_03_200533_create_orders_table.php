<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('code',10)->unique();
            $table->decimal('gift_sets',10,2)->nullable();
            $table->decimal('subtotal',10,2)->nullable();
            $table->decimal('tax',10,2)->nullable();
            $table->decimal('total',10,2)->nullable();
            $table->string('state')->nullable();
            $table->integer('user_id')->unsigned()->references('id')->on('users');
            $table->date('date_order')->nullable();
            $table->string('partial_delivery')->nullable();
            $table->string('delivery_address')->nullable();
            $table->text('commentaries')->nullable();
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
        Schema::dropIfExists('orders');
    }
}

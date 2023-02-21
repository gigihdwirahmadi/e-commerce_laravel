<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
      * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->decimal('total_price',10,2);
            $table->string('token',36)->nullable();
            $table->boolean('processed');
            $table->string('payment_type', 50);
            $table->string('transaction_status', 50);
            $table->enum('status', ['waiting', 'packing', 'delivery','finish']);
            $table->string('payment_url', 225);
            $table->timestamp('transaction_time');
            $table->timestamp('settlement_time');
            $table->boolean('delivery_status');
            $table->string('delivery_address',225);
            $table->foreign('user_id')->references('id')->on('users');
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
};
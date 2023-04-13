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
            $table->id();
            
            $table->integer('user_id')->nullable();
            $table->string('order_tracking_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->integer('number');
            $table->string('company_name')->nullable();
            $table->string('address_first');
            $table->string('address_second');
            $table->string('city');
            $table->string('country');
            $table->integer('product_price_subtotal');
            $table->enum('payment_process', ['cash', 'stripe']);
            $table->enum('status', ['pending', 'canceled','approved','shipped']);
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

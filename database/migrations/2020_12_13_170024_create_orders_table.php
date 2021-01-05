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
            $table->dateTime('time');
            $table->integer('status');
            $table->string('address');
            $table->string('receiver');
            $table->string('phone');
            $table->integer('fee_shipment');
            $table->string('type_shipment');
            $table->integer('status_payment');
            $table->string('type_payment');
            $table->integer('total_price');
            $table->foreignId('customer_id')->constrained('customers');
            $table->timestamps();
            $table->softDeletes();
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

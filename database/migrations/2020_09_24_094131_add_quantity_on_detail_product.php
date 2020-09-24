<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQuantityOnDetailProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasColumn('product_detail', 'quantity')) {
            Schema::table('product_detail', function (Blueprint $table) {
                $table->integer('quantity');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(Schema::hasColumn('product_detail', 'quantity')) {
            Schema::table('product_detail', function (Blueprint $table) {
                $table->dropColumn('quantity');
            });
        }
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemImportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_imports', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity');
            $table->integer('price_import');
            $table->foreignId('product_infor_id')->constrained('product_infors');
            $table->foreignId('import_id')->constrained('imports');
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
        Schema::dropIfExists('item_imports');
    }
}

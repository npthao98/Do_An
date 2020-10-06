<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPhoneAddressDropGenderInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('users', 'gender') && !Schema::hasColumn('users', ['phone', 'address'])) {
            Schema::table('users', function (Blueprint $table) {
                $table->integer('phone')->nullable();
                $table->string('address')->nullable();
                $table->dropColumn('gender');
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
        if (!Schema::hasColumn('users', 'gender') && Schema::hasColumn('users', ['phone', 'address'])) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('phone');
                $table->dropColumn('address');
                $table->string('gender')->nullable();
            });
        }
    }
}

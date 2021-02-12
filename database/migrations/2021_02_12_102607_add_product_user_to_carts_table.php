<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProductUserToCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained();
            $table->foreignId('product_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->dropColumn('product_id');
        });
    }
}

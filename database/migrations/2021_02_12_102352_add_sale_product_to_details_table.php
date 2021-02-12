<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSaleProductToDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('details', function (Blueprint $table) {
            $table->foreignId('sales_id')->constrained();
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
        Schema::table('details', function (Blueprint $table) {
            $table->dropColumn('sales_id');
            $table->dropColumn('product_id');
        });
    }
}

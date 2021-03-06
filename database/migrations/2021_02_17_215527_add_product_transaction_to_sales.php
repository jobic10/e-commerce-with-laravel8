<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProductTransactionToSales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */



    public function up()
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->foreignId('user_id')->after('id')->constrained()->onDelete('CASCADE');
            $table->foreignId('product_id')->after('user_id')->constrained()->onDelete('CASCADE');
            $table->foreignId('transaction_id')->after('product_id')->constrained()->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['product_id']);
            $table->dropForeign(['transaction_id']);
        });
    }
}
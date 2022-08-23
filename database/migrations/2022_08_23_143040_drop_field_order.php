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
        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('orders', function($table) {
        $table->dropColumn('name');
        $table->dropColumn('email');
        $table->dropColumn('phone');
        $table->dropColumn('address');
        $table->dropColumn('product_title');
        $table->dropColumn('image');
        $table->dropColumn('price');
        $table->dropColumn('payment_status');
        $table->dropColumn('delivery_status');
     });
    }
};

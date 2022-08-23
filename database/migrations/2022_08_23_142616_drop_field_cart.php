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
      Schema::table('carts', function($table) {
        $table->dropColumn('name');
        $table->dropColumn('email');
        $table->dropColumn('phone');
        $table->dropColumn('address');
        $table->dropColumn('product_title');
        $table->dropColumn('price');
        $table->dropColumn('image');
     });
    }
};

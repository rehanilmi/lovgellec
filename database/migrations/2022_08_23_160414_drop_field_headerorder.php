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
      Schema::table('header_orders', function($table) {
        $table->dropColumn('total_ongkir');
        $table->dropColumn('total');
        $table->dropColumn('kurir');
        $table->dropColumn('layanan');

     });
    }
};

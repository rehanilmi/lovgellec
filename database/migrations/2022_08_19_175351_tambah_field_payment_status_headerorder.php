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
      Schema::table('header_orders', function (Blueprint $table) {
          $table->string('snap_token', 36)->nullable();
          $table->enum('payment_status', ['1', '2', '3','4'])->comment('1=menunggu pembayaran, 2=sudah dibayar, 3=cod, 4=kadaluarsa');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};

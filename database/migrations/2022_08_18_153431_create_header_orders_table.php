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
        Schema::create('header_orders', function (Blueprint $table) {
          $table->id();
          $table->bigInteger('user_id');
          $table->decimal('total_belanja');
          $table->decimal('total_ongkir');
          $table->decimal('total');
          $table->bigInteger('count');
          $table->string('status');
          $table->string('kurir');
          $table->string('layanan');
          $table->date("tanggal_order");
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('header_orders');
    }
};

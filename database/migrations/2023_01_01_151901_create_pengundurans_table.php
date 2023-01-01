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
        Schema::create('pengundurans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_card');
            $table->string('name');
            $table->string('email');
            $table->string('tanggal');
            $table->string('alasan');
            $table->string('status');
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
        Schema::dropIfExists('pengundurans');
    }
};

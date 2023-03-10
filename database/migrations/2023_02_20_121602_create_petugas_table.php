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
        Schema::create('petugas', function (Blueprint $table) {
            $table->id('id_petugas', 11);
            $table->string('nama_petugas', 35);
            $table->string('email', 25)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('telp', 13);
            $table->enum('level',['admin','petugas']);
            $table->unsignedBigInteger('add_by')->nullable();
            $table->foreign('add_by')->references('id_petugas')->on('petugas');
            $table->unsignedBigInteger('edit_by')->nullable();
            $table->foreign('edit_by')->references('id_petugas')->on('petugas');
            $table->rememberToken();
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
        Schema::dropIfExists('petugas');
    }
};

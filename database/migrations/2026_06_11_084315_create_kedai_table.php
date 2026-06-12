<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kedai', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kedai');
            $table->text('alamat');
            $table->string('kontak')->nullable();
            $table->text('deskripsi')->nullable();
            $table->text('map_url')->nullable();
            $table->string('gambar')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kedai');
    }
};
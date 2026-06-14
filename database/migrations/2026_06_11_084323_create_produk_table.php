<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            // Relasi ke tabel kedai
            $table->foreignId('id_kedai')->constrained('kedai')->onDelete('cascade');
            $table->string('nama_produk');
            $table->integer('harga');
            $table->foreignId('id_kategori')->constrained('kategori')->cascadeOnDelete();
            $table->text('deskripsi')->nullable();
            $table->string('gambar')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('produk');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
    Schema::create('kategori_kedai', function (Blueprint $table) {
        $table->foreignId('id_kedai')->constrained('kedai')->cascadeOnDelete();
        $table->foreignId('id_kategori')->constrained('kategori')->cascadeOnDelete();
        $table->primary(['id_kedai', 'id_kategori']);
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_kedai');
    }
};

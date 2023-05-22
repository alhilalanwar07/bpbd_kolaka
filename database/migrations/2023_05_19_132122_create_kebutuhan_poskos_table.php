<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kebutuhan_poskos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('posko_id')->constrained('poskos');
            $table->foreignId('barang_id')->constrained('barangs');
            $table->integer('jumlah_kebutuhan');
            $table->enum('jenis_kebutuhan',['utama','tambahan'])->default('utama');
            $table->enum('status_kebutuhan',['pending','terdistribusi'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kebutuhan_poskos');
    }
};

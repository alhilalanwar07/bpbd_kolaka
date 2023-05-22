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
        Schema::create('stoks', function (Blueprint $table) {
            $table->id();
            // barang_id
            $table->foreignId('barang_id')->constrained('barangs')->onDelete('cascade');
            // satuan_id
            $table->foreignId('satuan_id')->constrained('satuans')->onDelete('cascade');
            // jumlah_masuk
            $table->integer('jumlah_masuk');
            // tgl_masuk
            $table->date('tgl_masuk');
            // harga_satuan
            $table->integer('harga_satuan');
            // total_harga
            $table->integer('total_harga');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stoks');
    }
};

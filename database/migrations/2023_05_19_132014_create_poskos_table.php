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
        Schema::create('poskos', function (Blueprint $table) {
            $table->id();
            $table->string('nama_posko');
            $table->string('nama_petugas');
            $table->string('alamat_posko');
            $table->string('no_hp');
            $table->float('latitude');
            $table->float('longitude');
            $table->integer('jumlah_pengungsi');
            $table->enum('status_posko',['aktif','nonaktif'])->default('aktif');

            // bencana_id
            $table->unsignedBigInteger('bencana_id');
            $table->foreign('bencana_id')->references('id')->on('bencanas')->onDelete('cascade');
            // kecamatan_id
            $table->unsignedBigInteger('kecamatan_id');
            $table->foreign('kecamatan_id')->references('id')->on('kecamatans')->onDelete('cascade');
            // user_id
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('poskos');
    }
};

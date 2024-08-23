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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('kode_tiket')->unique();
            $table->unsignedBigInteger('id_pelanggan');
            $table->string('nama_pelanggan');
            $table->date('tanggal_dibuat');
            $table->date('tanggal_perbaikan')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->string('nama_pic_fakultas');
            $table->string('telepon_pic_fakultas');
            $table->string('nama_pic_ruangan');
            $table->string('telepon_pic_ruangan');
            $table->text('keterangan')->nullable();
            $table->enum('status', ['menunggu', 'penugasan', 'dikerjakan', 'pending', 'dibatalkan', 'selesai'])->default('menunggu');
            $table->enum('kategori', [1,2,3,4,5,6,7,8,9])->default(1)->comment('1: menunggu, 2: admin memberi jadwal, 3: pelanggan konfirmasi setuju, 4: pelanggan konfirmasi tidak setuju, 5: admin memberi tugas, 6: teknisi menerima penugasan, 7: teknisi menolak penugasan, 8: teknisi lapor kendala, 9: teknisi lapor selesai');

            $table->foreign('id_pelanggan')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};

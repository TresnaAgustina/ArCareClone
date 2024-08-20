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
        Schema::create('ticket_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_tiket')->constrained('tickets')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('dibuat_oleh');
            $table->string('konteks');
            $table->enum('status', ['menunggu', 'penugasan', 'dikerjakan', 'pending', 'selesai', 'dibatalkan']);
            $table->date('tanggal_jadwal')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('jenis_kendala')->nullable();
            $table->string('aksi_diambil')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_logs');
    }
};

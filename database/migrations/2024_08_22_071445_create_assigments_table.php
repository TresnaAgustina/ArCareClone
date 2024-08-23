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
        Schema::create('assigments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_tiket')->constrained('tickets')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_teknisi')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nama_teknisi');
            $table->date('tanggal_perbaikan');
            $table->date('tanggal_selesai')->nullable();
            $table->enum('status', ['menunggu', 'dikerjakan', 'pending', 'selesai'])->default('menunggu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assigments');
    }
};

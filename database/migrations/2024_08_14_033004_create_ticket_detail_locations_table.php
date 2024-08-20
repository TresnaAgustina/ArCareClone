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
        Schema::create('ticket_detail_locations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_tiket');
            $table->string('lokasi');
            $table->text('alamat');

            $table->foreign('id_tiket')->references('id')->on('tickets')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_detail_locations');
    }
};

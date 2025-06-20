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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name')->comment('Nama acara');
            $table->string('slug')->unique()->comment('Slug acara');
            $table->text('description')->nullable()->comment('Deskripsi acara');
            $table->dateTime('start_date')->comment('Tanggal dan waktu mulai acara');
            $table->dateTime('end_date')->comment('Tanggal dan waktu selesai acara');
            $table->string('location')->comment('Lokasi acara');
            $table->string('organizer')->nullable()->comment('Penyelenggara acara');
            $table->string('contact_email')->nullable()->comment('Email kontak penyelenggara');
            $table->string('contact_phone')->nullable()->comment('Telepon kontak penyelenggara');
            $table->boolean('is_active')->default(true)->comment('Status aktif acara');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};

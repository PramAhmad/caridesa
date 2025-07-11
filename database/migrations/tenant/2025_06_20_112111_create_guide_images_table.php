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
        Schema::create('guide_images', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name')->nullable()->comment('Nama gambar pemandu wisata');
            $table->foreignId('guide_id')->constrained('guides')->onDelete('cascade')->comment('ID pemandu wisata');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guide_images');
    }
};

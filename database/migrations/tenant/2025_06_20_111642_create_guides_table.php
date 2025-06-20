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
        Schema::create('guides', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name')->nullable()->comment('Nama wisata');
            $table->string('address')->nullable()->comment('Alamat wisata');
            $table->string('phone')->nullable()->comment('Nomor telepon wisata');
            $table->string('email')->nullable()->comment('Email wisata');
            $table->longText('description')->nullable()->comment('Deskripsi wisata');
            $table->decimal('price', 10, 2)->nullable()->comment('Harga wisata');
            $table->decimal('discount_percent', 5, 2)->default(0)->comment('Persentase diskon wisata');
            $table->boolean('is_active')->default(true)->comment('Status aktif wisata');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guides');
    }
};

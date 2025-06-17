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
        Schema::create('category_products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name')->comment('Nama kategori produk');
            $table->string('slug')->unique()->comment('Slug kategori produk');
            $table->text('description')->nullable()->comment('Deskripsi kategori produk');
            $table->boolean('is_active')->default(true)->comment('Status aktif kategori produk');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_products');
    }
};

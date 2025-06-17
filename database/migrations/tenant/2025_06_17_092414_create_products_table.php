<?php

use App\Enum\ProductStockStatus;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name')->comment('Nama produk');
            $table->string('slug')->unique()->comment('Slug produk');
            $table->foreignId('category_product_id')->constrained('category_products')->onDelete('cascade');
            $table->longText('description')->nullable()->comment('Deskripsi produk');
            $table->decimal('price', 10, 2)->comment('Harga produk');
            $table->enum('stock', ProductStockStatus::values())
            ->default(ProductStockStatus::IN_STOCK->value)
            ->comment('Status stok produk');
            $table->decimal('discount', 5, 2)->default(0)->comment('Diskon produk dalam persen');
            $table->boolean('is_active')->default(true)->comment('Status aktif produk');
            $table->string('image')->nullable()->comment('Gambar produk');
            $table->json('links')->nullable()->comment('Link ke olshop atau marketplace');
            $table->softDeletes();
            

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

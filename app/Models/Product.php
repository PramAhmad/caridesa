<?php

namespace App\Models;

use App\Enum\ProductStockStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'category_product_id',
        'description',
        'price',
        'stock',
        'discount',
        'is_active',
        'image',
        'links',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'discount' => 'decimal:2',
        'is_active' => 'boolean',
        'links' => 'array',
        'stock' => ProductStockStatus::class,
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // Relationships
    public function category()
    {
        return $this->belongsTo(CategoryProduct::class, 'category_product_id');
    }

    // Accessors
    /**
     * Get stock badge CSS class
     */
    public function getStockBadgeClassAttribute(): string
    {
        return match($this->stock) {
            ProductStockStatus::IN_STOCK => 'bg-success',
            ProductStockStatus::LOW_STOCK => 'bg-warning',
            ProductStockStatus::OUT_OF_STOCK => 'bg-danger',
            ProductStockStatus::PREORDER => 'bg-info',
            default => 'bg-secondary'
        };
    }

    /**
     * Get stock label
     */
    public function getStockLabelAttribute(): string
    {
        return $this->stock->label();
    }

    /**
     * Get image URL
     */
    public function getImageUrlAttribute(): string
    {
        if ($this->image) {
            return asset("tenancy/assets/image/products/{$this->image}");
        }
        return asset('tenant/images/placeholder-product.png');
    }

    /**
     * Check if product has discount
     */
 
    /**
     * Get formatted price
     */
    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    /**
     * Get discounted price
     */
    public function getDiscountedPriceAttribute(): float
    {
        if ($this->discount > 0) {
            return $this->price - ($this->price * $this->discount / 100);
        }
        return $this->price;
    }

    /**
     * Get formatted discounted price
     */
    public function getFormattedDiscountedPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->discounted_price, 0, ',', '.');
    }

    /**
     * Get links as array
     */


    // Mutators
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function setLinksAttribute($value)
    {
        $this->attributes['links'] = is_array($value) ? json_encode($value) : $value;
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeInStock($query)
    {
        return $query->where('stock', ProductStockStatus::IN_STOCK);
    }

    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_product_id', $categoryId);
    }

    public function scopeSearch($query, $term)
    {
        return $query->where(function ($q) use ($term) {
            $q->where('name', 'like', "%{$term}%")
              ->orWhere('description', 'like', "%{$term}%");
        });
    }

    public function scopeWithDiscount($query)
    {
        return $query->where('discount', '>', 0);
    }

    public function hasDiscount()
    {
        return $this->discount > 0;
    }

    public function isAvailable()
    {
        return $this->is_active && $this->stock !== ProductStockStatus::OUT_OF_STOCK;
    }

    public function getLinksArray()
    {
        return is_string($this->links) ? json_decode($this->links, true) : $this->links;
    }
}
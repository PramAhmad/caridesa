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
        'views',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'discount' => 'decimal:2',
        'is_active' => 'boolean',
        'stock' => ProductStockStatus::class,
        'views' => 'integer',
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
     * Get image URL with proper fallback
     */
    public function getImageUrlAttribute(): string
    {
        if ($this->image) {
            // Check if it's already a full URL
            if (filter_var($this->image, FILTER_VALIDATE_URL)) {
                return $this->image;
            }
            
            // Check if file exists in storage
            $imagePath = public_path("tenancy/assets/image/products/{$this->image}");
            if (file_exists($imagePath)) {
                return asset("tenancy/assets/image/products/{$this->image}");
            }
            
            // Try without tenancy path
            $imagePath2 = public_path($this->image);
            if (file_exists($imagePath2)) {
                return asset($this->image);
            }
        }
        
        // Default placeholder
        return 'https://via.placeholder.com/400x300/f59e0b/ffffff?text=No+Image';
    }

    /**
     * Check if product has discount
     */
    public function hasDiscount(): bool
    {
        return $this->discount > 0;
    }

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
     * Get links as array - Fixed version
     */
    public function getLinksArray()
    {
        if (empty($this->links)) {
            return [];
        }

        // If it's already an array, return as is
        if (is_array($this->links)) {
            return $this->links;
        }

        // If it's a JSON string, decode it
        if (is_string($this->links)) {
            $decoded = json_decode($this->links, true);
            return is_array($decoded) ? $decoded : [];
        }

        return [];
    }

    // Mutators
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function setLinksAttribute($value)
    {
        if (is_array($value)) {
            $this->attributes['links'] = json_encode($value);
        } elseif (is_string($value)) {
            // Check if it's already valid JSON
            $decoded = json_decode($value, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $this->attributes['links'] = $value;
            } else {
                // If it's not JSON, wrap it in an array
                $this->attributes['links'] = json_encode([$value]);
            }
        } else {
            $this->attributes['links'] = json_encode([]);
        }
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

    public function isAvailable()
    {
        return $this->is_active && $this->stock !== ProductStockStatus::OUT_OF_STOCK;
    }
}
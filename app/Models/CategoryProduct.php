<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class CategoryProduct extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'category_products';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // Relationships
    public function products()
    {
        return $this->hasMany(Product::class, 'category_product_id');
    }

    public function activeProducts()
    {
        return $this->hasMany(Product::class, 'category_product_id')
                    ->where('is_active', true);
    }

    // Accessors
    public function getProductsCountAttribute()
    {
        return $this->products()->count();
    }

    public function getActiveProductsCountAttribute()
    {
        return $this->activeProducts()->count();
    }

    // Mutators
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeWithProducts($query)
    {
        return $query->has('products');
    }

    public function scopeWithActiveProducts($query)
    {
        return $query->whereHas('activeProducts');
    }

    public function scopeSearch($query, $term)
    {
        return $query->where(function ($q) use ($term) {
            $q->where('name', 'like', "%{$term}%")
              ->orWhere('description', 'like', "%{$term}%");
        });
    }

    // Methods
    public function hasProducts()
    {
        return $this->products()->exists();
    }

    public function hasActiveProducts()
    {
        return $this->activeProducts()->exists();
    }
}
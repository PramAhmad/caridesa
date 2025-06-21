<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Wisata extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'latitude',
        'longitude',
        'category_wisata_id',
    ];

    protected $casts = [
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get the URL for the wisata.
     */
    public function getUrlAttribute()
    {
        return url('/wisata/' . $this->slug);
    }

    /**
     * Get the category that owns the wisata.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(CategoryWisata::class, 'category_wisata_id');
    }

    /**
     * Get the images for the wisata.
     */
    public function images(): HasMany
    {
        return $this->hasMany(WisataImage::class, 'wisata_id');
    }

    /**
     * Get the main image for the wisata.
     */
    public function getMainImageAttribute()
    {
        return $this->images()->first();
    }

    /**
     * Get the main image URL with proper fallback
     */
    public function getMainImageUrlAttribute()
    {
        $mainImage = $this->main_image;
        
        if ($mainImage && $mainImage->name) {
            // Check if it's already a full URL
            if (filter_var($mainImage->name, FILTER_VALIDATE_URL)) {
                return $mainImage->name;
            }
            
            // Check various possible paths
            $paths = [
                "tenancy/assets/image/wisata/{$mainImage->name}",
                "storage/wisata/{$mainImage->name}",
                $mainImage->name
            ];
            
            foreach ($paths as $path) {
                if (file_exists(public_path($path))) {
                    return asset($path);
                }
            }
        }
        
        // Default placeholder for wisata
        return 'https://via.placeholder.com/400x300/22c55e/ffffff?text=Wisata';
    }

    /**
     * Get formatted price (mock data since no price column)
     */
    public function getFormattedPriceAttribute()
    {
        // Since there's no price column, return "Gratis" or mock price
        return 'Gratis';
    }

    /**
     * Get views count (mock since no views column)
     */
    public function getViewsAttribute()
    {
        return rand(50, 500); // Mock views for display
    }

    /**
     * Get rating (mock since no rating column) 
     */
    public function getRatingAttribute()
    {
        return number_format(rand(40, 50) / 10, 1); // Mock rating 4.0-5.0
    }

    /**
     * Get status label for wisata (mock since no status column)
     */
    public function getStatusLabelAttribute()
    {
        return 'Tersedia';
    }

    /**
     * Check if active (mock since no is_active column)
     */
    public function getIsActiveAttribute()
    {
        return true; // Assume all wisata are active
    }

    /**
     * Get Google Maps URL.
     */
    public function getGoogleMapsUrlAttribute()
    {
        if ($this->latitude && $this->longitude) {
            return "https://www.google.com/maps?q={$this->latitude},{$this->longitude}";
        }
        return null;
    }

    /**
     * Get the formatted coordinates.
     */
    public function getCoordinatesAttribute()
    {
        if ($this->latitude && $this->longitude) {
            return "{$this->latitude}, {$this->longitude}";
        }
        return null;
    }

    /**
     * Scope for specific category
     */
    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_wisata_id', $categoryId);
    }

    /**
     * Scope for search
     */
    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
    }

    /**
     * Get image one
     */
    public function getImageOneAttribute()
    {
        return $this->images()->first();
    }

    /**
     * Auto generate slug when name is set
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        if (empty($this->attributes['slug'])) {
            $this->attributes['slug'] = Str::slug($value);
        }
    }
}

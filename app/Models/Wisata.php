<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        return url('/wisatas/' . $this->slug);
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
     * Get the main image URL (sama seperti Product).
     */
    public function getMainImageUrlAttribute()
    {
        $mainImage = $this->main_image;
        return $mainImage ? $mainImage->url : asset('tenant/images/placeholder-wisata.jpg');
    }

    /**
     * Get the Google Maps URL.
     */
    public function getGoogleMapsUrlAttribute()
    {
        return "https://www.google.com/maps?q={$this->latitude},{$this->longitude}";
    }

    /**
     * Get the formatted coordinates.
     */
    public function getCoordinatesAttribute()
    {
        return "{$this->latitude}, {$this->longitude}";
    }

    /**
     * Scope for specific category
     */
    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    /**
     * Scope for search
     */
    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
    }
    // image one
    public function getImageOneAttribute()
    {
        return $this->images()->first();
    }
}

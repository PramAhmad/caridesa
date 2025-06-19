<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategoryWisata extends Model
{
    protected $table = 'category_wisatas';
    
    protected $fillable = [
        'name',
        'slug',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
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
     * Get the URL for the category.
     */
    public function getUrlAttribute()
    {
        return route('category-wisatas.show', $this->slug);
    }

    /**
     * Get wisatas that belong to this category.
     */
    public function wisatas(): HasMany
    {
        return $this->hasMany(Wisata::class, 'category_wisata_id');
    }

    /**
     * Scope for active categories
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get wisatas count attribute
     */
    public function getWisatasCountAttribute()
    {
        return $this->wisatas()->count();
    }
}
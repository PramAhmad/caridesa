<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GuideImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'guide_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relationship with Guide
     */
    public function guide()
    {
        return $this->belongsTo(Guide::class, 'guide_id');
    }

    /**
     * Get the full URL for the image
     */
    public function getUrlAttribute()
    {
        return asset('tenancy/assets' . $this->name);
    }

    /**
     * Get the image file name without path
     */
    public function getFilenameAttribute()
    {
        return basename($this->name);
    }

    /**
     * Get the image file extension
     */
    public function getExtensionAttribute()
    {
        return pathinfo($this->name, PATHINFO_EXTENSION);
    }

    /**
     * Check if image file exists
     */
    public function exists()
    {
        return file_exists(public_path('tenancy/assets' . $this->name));
    }
}

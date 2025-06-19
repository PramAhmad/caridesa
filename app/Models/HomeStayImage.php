<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HomeStayImage extends Model
{
    protected $fillable = [
        'name',
        'home_stay_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName()
    {
        return 'id';
    }

    /**
     * Get the URL for the image (sama seperti Product dan Wisata).
     */
    public function getUrlAttribute()
    {
        return asset('tenancy/assets' . $this->name);
    }

    /**
     * Get the full path for the image.
     */
    public function getFullPathAttribute()
    {
        return public_path('tenancy/assets' . $this->name);
    }

    /**
     * Get the homestay that owns this image.
     */
    public function homeStay(): BelongsTo
    {
        return $this->belongsTo(HomeStay::class, 'home_stay_id');
    }

    /**
     * Get the file name only.
     */
    public function getFileNameAttribute()
    {
        return basename($this->name);
    }

    /**
     * Get the file extension.
     */
    public function getFileExtensionAttribute()
    {
        return pathinfo($this->name, PATHINFO_EXTENSION);
    }

    /**
     * Get the file size (if needed).
     */
    public function getFileSizeAttribute()
    {
        $fullPath = $this->full_path;
        if (file_exists($fullPath)) {
            return filesize($fullPath);
        }
        return 0;
    }

    /**
     * Get the formatted file size.
     */
    public function getFormattedFileSizeAttribute()
    {
        $bytes = $this->file_size;
        if ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        } else {
            return $bytes . ' bytes';
        }
    }

    /**
     * Check if the image file exists.
     */
    public function getExistsAttribute()
    {
        return file_exists($this->full_path);
    }

    /**
     * Get image dimensions (if needed).
     */
    public function getDimensionsAttribute()
    {
        if ($this->exists) {
            $imageInfo = getimagesize($this->full_path);
            if ($imageInfo) {
                return [
                    'width' => $imageInfo[0],
                    'height' => $imageInfo[1],
                    'type' => $imageInfo[2],
                    'mime' => $imageInfo['mime']
                ];
            }
        }
        return null;
    }

    /**
     * Get the thumbnail URL (for future implementation).
     */
    public function getThumbnailUrlAttribute()
    {
        // For now, return the same URL
        // Later you can implement thumbnail generation
        return $this->url;
    }

    /**
     * Scope for specific homestay.
     */
    public function scopeForHomeStay($query, $homeStayId)
    {
        return $query->where('home_stay_id', $homeStayId);
    }

    /**
     * Boot method for model events.
     */
    protected static function boot()
    {
        parent::boot();

        // Delete physical file when model is deleted
        static::deleting(function ($image) {
            if (file_exists($image->full_path)) {
                unlink($image->full_path);
            }
        });
    }
}
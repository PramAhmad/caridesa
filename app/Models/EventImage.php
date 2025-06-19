<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventImage extends Model
{
    protected $fillable = [
        'name',
        'event_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relationship with Event
     */
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    /**
     * Get full URL for the image
     */
    public function getUrlAttribute()
    {
        if (empty($this->name)) {
            return asset('tenancy/assets/image/default-event.jpg');
        }

        if (str_starts_with($this->name, 'http')) {
            return $this->name;
        }

        if (str_starts_with($this->name, '/')) {
            return asset('tenancy/assets' . $this->name);
        }

        return asset('tenancy/assets/image/events/' . $this->name);
    }

    /**
     * Get file path for storage operations
     */
    public function getFilePathAttribute()
    {
        if (empty($this->name)) {
            return null;
        }

        if (str_starts_with($this->name, '/')) {
            return public_path('tenancy/assets' . $this->name);
        }

        return public_path('tenancy/assets/image/events/' . $this->name);
    }

    /**
     * Get file name without path
     */
    public function getFileNameAttribute()
    {
        if (empty($this->name)) {
            return null;
        }

        return basename($this->name);
    }

    /**
     * Get file extension
     */
    public function getExtensionAttribute()
    {
        if (empty($this->name)) {
            return null;
        }

        return pathinfo($this->name, PATHINFO_EXTENSION);
    }

    /**
     * Get file size in bytes
     */
    public function getFileSizeAttribute()
    {
        $filePath = $this->file_path;
        
        if ($filePath && file_exists($filePath)) {
            return filesize($filePath);
        }

        return 0;
    }

    /**
     * Get formatted file size
     */
    public function getFormattedFileSizeAttribute()
    {
        $bytes = $this->file_size;
        
        if ($bytes === 0) {
            return '0 Bytes';
        }

        $k = 1024;
        $sizes = ['Bytes', 'KB', 'MB', 'GB'];
        $i = floor(log($bytes) / log($k));

        return round($bytes / pow($k, $i), 2) . ' ' . $sizes[$i];
    }

    /**
     * Check if file exists
     */
    public function getExistsAttribute()
    {
        $filePath = $this->file_path;
        return $filePath && file_exists($filePath);
    }

    /**
     * Get image dimensions if it's an image
     */
    public function getDimensionsAttribute()
    {
        $filePath = $this->file_path;
        
        if (!$filePath || !file_exists($filePath)) {
            return null;
        }

        $imageInfo = getimagesize($filePath);
        
        if ($imageInfo === false) {
            return null;
        }

        return [
            'width' => $imageInfo[0],
            'height' => $imageInfo[1],
            'type' => $imageInfo[2],
            'mime' => $imageInfo['mime'] ?? null,
        ];
    }

    /**
     * Get formatted dimensions string
     */
    public function getFormattedDimensionsAttribute()
    {
        $dimensions = $this->dimensions;
        
        if (!$dimensions) {
            return null;
        }

        return $dimensions['width'] . ' x ' . $dimensions['height'] . ' px';
    }

    /**
     * Check if image is landscape
     */
    public function getIsLandscapeAttribute()
    {
        $dimensions = $this->dimensions;
        
        if (!$dimensions) {
            return null;
        }

        return $dimensions['width'] > $dimensions['height'];
    }

    /**
     * Check if image is portrait
     */
    public function getIsPortraitAttribute()
    {
        $dimensions = $this->dimensions;
        
        if (!$dimensions) {
            return null;
        }

        return $dimensions['height'] > $dimensions['width'];
    }

    /**
     * Check if image is square
     */
    public function getIsSquareAttribute()
    {
        $dimensions = $this->dimensions;
        
        if (!$dimensions) {
            return null;
        }

        return $dimensions['width'] === $dimensions['height'];
    }

    /**
     * Get aspect ratio
     */
    public function getAspectRatioAttribute()
    {
        $dimensions = $this->dimensions;
        
        if (!$dimensions) {
            return null;
        }

        return round($dimensions['width'] / $dimensions['height'], 2);
    }

    /**
     * Get thumbnail URL (assuming thumbnails are generated)
     */
    public function getThumbnailUrlAttribute()
    {
        if (empty($this->name)) {
            return asset('tenancy/assets/image/default-event-thumb.jpg');
        }

        $pathInfo = pathinfo($this->name);
        $thumbnailName = $pathInfo['filename'] . '_thumb.' . $pathInfo['extension'];

        if (str_starts_with($this->name, '/')) {
            return asset('tenancy/assets' . str_replace($pathInfo['basename'], $thumbnailName, $this->name));
        }

        return asset('tenancy/assets/image/events/thumbs/' . $thumbnailName);
    }

    /**
     * Get alt text for image
     */
    public function getAltTextAttribute()
    {
        if ($this->event) {
            return 'Foto acara ' . $this->event->name;
        }

        return 'Foto acara';
    }

    /**
     * Scope for existing files
     */
    public function scopeExisting($query)
    {
        return $query->whereNotNull('name')->where('name', '!=', '');
    }

    /**
     * Boot method for model events
     */
    protected static function boot()
    {
        parent::boot();

        // Clean up file when model is deleted
        static::deleting(function ($eventImage) {
            if ($eventImage->exists && $eventImage->file_path) {
                @unlink($eventImage->file_path);
                
                // Also try to delete thumbnail if exists
                $thumbnailPath = str_replace('/events/', '/events/thumbs/', $eventImage->file_path);
                $thumbnailPath = str_replace('.', '_thumb.', $thumbnailPath);
                @unlink($thumbnailPath);
            }
        });
    }
}

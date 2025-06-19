<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WisataImage extends Model
{
    protected $fillable = [
        'name',
        'wisata_id',
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
     * Get the URL for the image (sama seperti Product).
     */
    public function getUrlAttribute()
    {
        return asset('tenancy/assets' . $this->name);
    }

    /**
     * Get the wisata that owns this image.
     */
    public function wisata()
    {
        return $this->belongsTo(Wisata::class, 'wisata_id');
    }
}

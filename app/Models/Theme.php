<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'preview_image',
        'config',
        'is_active'
    ];

    protected $casts = [
        'config' => 'array',
        'is_active' => 'boolean'
    ];

    public function contents()
    {
        return $this->hasMany(ThemeContent::class)->orderBy('order');
    }

    public function activeContents()
    {
        return $this->hasMany(ThemeContent::class)->where('is_active', true)->orderBy('order');
    }
}
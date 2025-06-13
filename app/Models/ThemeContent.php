<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThemeContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'theme_id',
        'section',
        'title',
        'content',
        'image',
        'settings',
        'order',
        'is_active'
    ];

    protected $casts = [
        'settings' => 'array',
        'is_active' => 'boolean'
    ];

    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }
}
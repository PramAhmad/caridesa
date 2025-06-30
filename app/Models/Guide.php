<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Guide extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'description',
        'price',
        'discount_percent',
        'is_active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'discount_percent' => 'decimal:2',
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relationship with GuideImage
     */
    public function images()
    {
        return $this->hasMany(GuideImage::class, 'guide_id');
    }

    /**
     * Get the main image for the guide
     */
    public function getMainImageAttribute()
    {
        return $this->images()->first();
    }

    /**
     * Get the main image URL
     */
    public function getMainImageUrlAttribute()
    {
        $mainImage = $this->main_image;
        if ($mainImage) {
            return asset( $mainImage->name);
        }
        return asset('tenant/images/default-guide.jpg'); // Default image
    }

    /**
     * Get images count
     */
    public function getImagesCountAttribute()
    {
        return $this->images()->count();
    }

    /**
     * Get formatted price
     */
    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    /**
     * Get discounted price
     */
    public function getDiscountedPriceAttribute()
    {
        if ($this->discount_percent > 0) {
            return $this->price - ($this->price * $this->discount_percent / 100);
        }
        return $this->price;
    }

    /**
     * Get formatted discounted price
     */
    public function getFormattedDiscountedPriceAttribute()
    {
        return 'Rp ' . number_format($this->discounted_price, 0, ',', '.');
    }

    /**
     * Check if guide has discount
     */
    public function hasDiscount()
    {
        return $this->discount_percent > 0;
    }

    /**
     * Get status label
     */
    public function getStatusLabelAttribute()
    {
        return $this->is_active ? 'Tersedia' : 'Tidak Tersedia';
    }

    /**
     * Get status color
     */
    public function getStatusColorAttribute()
    {
        return $this->is_active ? 'success' : 'secondary';
    }

    // Mock data methods
    public function getViewsAttribute()
    {
        return rand(30, 200);
    }

    public function getRatingAttribute()
    {
        return number_format(rand(40, 50) / 10, 1);
    }

    public function getExperienceYearsAttribute()
    {
        return rand(2, 15);
    }

    public function getLanguagesAttribute()
    {
        $languages = [
            ['Indonesia', 'Inggris'],
            ['Indonesia', 'Inggris', 'Mandarin'],
            ['Indonesia', 'Inggris', 'Jepang'],
            ['Indonesia', 'Inggris', 'Arab'],
            ['Indonesia'],
        ];
        return $languages[array_rand($languages)];
    }

    public function getSpecialtyAttribute()
    {
        $specialties = [
            'Wisata Alam', 'Wisata Budaya', 'Wisata Religi', 
            'Wisata Kuliner', 'Wisata Sejarah', 'Wisata Adventure'
        ];
        return $specialties[array_rand($specialties)];
    }

    public function getAvailabilityAttribute()
    {
        $statuses = ['Tersedia', 'Sibuk', 'Tersedia Terbatas'];
        return $statuses[array_rand($statuses)];
    }

    public function getTourPackagesAttribute()
    {
        return collect([
            (object) ['name' => 'Paket Half Day', 'duration' => '4 jam', 'price' => $this->price * 0.6],
            (object) ['name' => 'Paket Full Day', 'duration' => '8 jam', 'price' => $this->price],
            (object) ['name' => 'Paket 2 Hari 1 Malam', 'duration' => '2D1N', 'price' => $this->price * 1.8],
        ]);
    }

    public function getCertificationsAttribute()
    {
        return collect([
            (object) ['name' => 'Sertifikat Guide Profesional'],
            (object) ['name' => 'Sertifikat Keselamatan Wisata'],
            (object) ['name' => 'Sertifikat Bahasa Asing'],
        ])->take(rand(1, 3));
    }

    // Existing scopes and methods...
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeInactive($query)
    {
        return $query->where('is_active', false);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function($q) use ($search) {
            $q->where('name', 'LIKE', "%{$search}%")
              ->orWhere('description', 'LIKE', "%{$search}%")
              ->orWhere('address', 'LIKE', "%{$search}%")
              ->orWhere('phone', 'LIKE', "%{$search}%")
              ->orWhere('email', 'LIKE', "%{$search}%");
        });
    }

    public function scopePriceRange($query, $minPrice, $maxPrice)
    {
        return $query->whereBetween('price', [$minPrice, $maxPrice]);
    }

    public function scopeWithDiscount($query)
    {
        return $query->where('discount_percent', '>', 0);
    }

    public function getRouteKeyName()
    {
        return 'id';
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class HomeStay extends Model
{
    protected $fillable = [
        'name',
        'description',
        'address',
        'phone',
        'email',
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
     * Get the route key for the model.
     */
    public function getRouteKeyName()
    {
        return 'id';
    }

    /**
     * Get the URL for the homestay.
     */
    public function getUrlAttribute()
    {
        return url('/homestays/' . $this->id);
    }

    /**
     * Get the images for the homestay.
     */
    public function images(): HasMany
    {
        return $this->hasMany(HomeStayImage::class, 'home_stay_id');
    }

    /**
     * Get the main image for the homestay.
     */
    public function getMainImageAttribute()
    {
        return $this->images()->first();
    }   

    /**
     * Get the main image URL (sama seperti Product dan Wisata).
     */
    public function getMainImageUrlAttribute()
    {
        $mainImage = $this->main_image;
        return $mainImage ? $mainImage->url : asset('tenant/images/placeholder-homestay.jpg');
    }

    /**
     * Get the formatted price.
     */


    /**
     * Get the discounted price.
     */
    public function getDiscountedPriceAttribute()
    {
        if ($this->discount_percent > 0) {
            $discountAmount = ($this->price * $this->discount_percent) / 100;
            return $this->price - $discountAmount;
        }
        return $this->price;
    }

    // Mock attributes for missing columns
    public function getViewsAttribute()
    {
        return rand(50, 300);
    }

    public function getRatingAttribute()
    {
        return number_format(rand(40, 50) / 10, 1);
    }

    public function getStatusBadgeAttribute()
    {
        return 'Tersedia';
    }

    public function getCapacityAttribute()
    {
        return rand(2, 8) . ' orang';
    }

    public function getRoomsAttribute()
    {
        return rand(1, 4) . ' kamar';
    }

    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format(rand(150000, 500000), 0, ',', '.');
    }

    public function getHasDiscountAttribute()
    {
        return rand(0, 1) === 1;
    }

    public function getDiscountPercentAttribute()
    {
        return $this->has_discount ? rand(10, 30) : 0;
    }

    public function getFormattedDiscountedPriceAttribute()
    {
        if (!$this->has_discount) {
            return $this->formatted_price;
        }

        $originalPrice = rand(150000, 500000);
        $discountedPrice = $originalPrice - ($originalPrice * $this->discount_percent / 100);
        return 'Rp ' . number_format($discountedPrice, 0, ',', '.');
    }

    public function getFormattedDiscountAmountAttribute()
    {
        if (!$this->has_discount) {
            return 'Rp 0';
        }

        $originalPrice = rand(150000, 500000);
        $discountAmount = $originalPrice * $this->discount_percent / 100;
        return 'Rp ' . number_format($discountAmount, 0, ',', '.');
    }

    public function getGoogleMapsEmbedAttribute()
    {
        // Mock Google Maps embed parameter
        return '!1m18!1m12!1m3!1d3966.521260322283!2d106.8219!3d-6.1754!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f5d2e764b12d%3A0x3d2ad6e1e0e9bcc8!2sJakarta!5e0!3m2!1sen!2sid!4v1234567890123';
    }

    // Relationships with mock data
    public function getFacilitiesAttribute()
    {
        return collect([
            (object) ['name' => 'WiFi Gratis'],
            (object) ['name' => 'AC'],
            (object) ['name' => 'Kamar Mandi Dalam'],
            (object) ['name' => 'Sarapan'],
            (object) ['name' => 'Parkir'],
            (object) ['name' => 'TV'],
        ])->take(rand(3, 6));
    }

    public function getReviewsAttribute()
    {
        return collect(); // Empty collection for now
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
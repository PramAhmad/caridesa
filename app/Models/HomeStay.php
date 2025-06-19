<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class HomeStay extends Model
{
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
    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

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

    /**
     * Get the formatted discounted price.
     */
    public function getFormattedDiscountedPriceAttribute()
    {
        return 'Rp ' . number_format($this->discounted_price, 0, ',', '.');
    }

    /**
     * Get the discount amount.
     */
    public function getDiscountAmountAttribute()
    {
        if ($this->discount_percent > 0) {
            return ($this->price * $this->discount_percent) / 100;
        }
        return 0;
    }

    /**
     * Get the formatted discount amount.
     */
    public function getFormattedDiscountAmountAttribute()
    {
        return 'Rp ' . number_format($this->discount_amount, 0, ',', '.');
    }

    /**
     * Check if homestay has discount.
     */
    public function getHasDiscountAttribute()
    {
        return $this->discount_percent > 0;
    }

    /**
     * Get the status badge.
     */
    public function getStatusBadgeAttribute()
    {
        return $this->is_active ? 
            '<span class="badge rounded-pill badge-success">Aktif</span>' : 
            '<span class="badge rounded-pill badge-secondary">Tidak Aktif</span>';
    }

    /**
     * Get the contact info formatted.
     */
    public function getContactInfoAttribute()
    {
        $contacts = [];
        if ($this->phone) {
            $contacts[] = '📞 ' . $this->phone;
        }
        if ($this->email) {
            $contacts[] = '✉️ ' . $this->email;
        }
        return implode(' | ', $contacts);
    }

    /**
     * Get the WhatsApp URL.
     */
    public function getWhatsappUrlAttribute()
    {
        if ($this->phone) {
            $phone = preg_replace('/[^0-9]/', '', $this->phone);
            if (substr($phone, 0, 1) === '0') {
                $phone = '62' . substr($phone, 1);
            }
            $message = urlencode('Halo, saya tertarik dengan homestay ' . $this->name);
            return "https://wa.me/{$phone}?text={$message}";
        }
        return null;
    }

    /**
     * Scope for active homestays.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for homestays with discount.
     */
    public function scopeWithDiscount($query)
    {
        return $query->where('discount_percent', '>', 0);
    }

    /**
     * Scope for search.
     */
    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
    }

    /**
     * Scope for price range.
     */
    public function scopePriceRange($query, $minPrice = null, $maxPrice = null)
    {
        if ($minPrice !== null) {
            $query->where('price', '>=', $minPrice);
        }
        if ($maxPrice !== null) {
            $query->where('price', '<=', $maxPrice);
        }
        return $query;
    }

    /**
     * Boot method for model events.
     */
    protected static function boot()
    {
        parent::boot();

        // Auto-generate slug when creating (if needed later)
        static::creating(function ($homestay) {
            // You can add slug generation here if needed
        });
    }
}
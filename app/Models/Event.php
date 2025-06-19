<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Event extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'start_date',
        'end_date',
        'location',
        'organizer',
        'contact_email',
        'contact_phone',
        'is_active',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relationship with EventImage
     */
    public function images(): HasMany
    {
        return $this->hasMany(EventImage::class, 'event_id');
    }

    /**
     * Boot method to auto-generate slug
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($event) {
            if (empty($event->slug)) {
                $event->slug = Str::slug($event->name);
            }
        });

        static::updating(function ($event) {
            if ($event->isDirty('name') && empty($event->slug)) {
                $event->slug = Str::slug($event->name);
            }
        });
    }

    /**
     * Get route key name for route model binding
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Scope for active events
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for upcoming events
     */
    public function scopeUpcoming($query)
    {
        return $query->where('start_date', '>', now());
    }

    /**
     * Scope for ongoing events
     */
    public function scopeOngoing($query)
    {
        return $query->where('start_date', '<=', now())
                    ->where('end_date', '>=', now());
    }

    /**
     * Scope for past events
     */
    public function scopePast($query)
    {
        return $query->where('end_date', '<', now());
    }

    /**
     * Check if event is upcoming
     */
    public function getIsUpcomingAttribute()
    {
        return $this->start_date > now();
    }

    /**
     * Check if event is ongoing
     */
    public function getIsOngoingAttribute()
    {
        return $this->start_date <= now() && $this->end_date >= now();
    }

    /**
     * Check if event is past
     */
    public function getIsPastAttribute()
    {
        return $this->end_date < now();
    }

    /**
     * Get event status
     */
    public function getStatusAttribute()
    {
        if ($this->is_upcoming) {
            return 'upcoming';
        } elseif ($this->is_ongoing) {
            return 'ongoing';
        } else {
            return 'past';
        }
    }

    /**
     * Get event status label
     */
    public function getStatusLabelAttribute()
    {
        switch ($this->status) {
            case 'upcoming':
                return 'Akan Datang';
            case 'ongoing':
                return 'Sedang Berlangsung';
            case 'past':
                return 'Selesai';
            default:
                return 'Tidak Diketahui';
        }
    }

    /**
     * Get event status color
     */
    public function getStatusColorAttribute()
    {
        switch ($this->status) {
            case 'upcoming':
                return 'primary';
            case 'ongoing':
                return 'success';
            case 'past':
                return 'secondary';
            default:
                return 'dark';
        }
    }

    /**
     * Get formatted start date
     */
    public function getFormattedStartDateAttribute()
    {
        return $this->start_date->format('d M Y, H:i');
    }

    /**
     * Get formatted end date
     */
    public function getFormattedEndDateAttribute()
    {
        return $this->end_date->format('d M Y, H:i');
    }

    /**
     * Get date range string
     */
    public function getDateRangeAttribute()
    {
        $start = $this->start_date;
        $end = $this->end_date;

        // Same day
        if ($start->isSameDay($end)) {
            return $start->format('d M Y') . ' • ' 
                 . $start->format('H:i') . ' - ' . $end->format('H:i');
        }

        // Different days
        return $start->format('d M Y, H:i') . ' - ' . $end->format('d M Y, H:i');
    }

    /**
     * Get human readable date range
     */
    public function getHumanDateRangeAttribute()
    {
        $start = $this->start_date;
        $end = $this->end_date;

        if ($start->isSameDay($end)) {
            return $start->format('d F Y') . ' pukul ' 
                 . $start->format('H:i') . ' - ' . $end->format('H:i') . ' WIB';
        }

        return $start->format('d F Y, H:i') . ' - ' . $end->format('d F Y, H:i') . ' WIB';
    }

    /**
     * Get duration in hours
     */
    public function getDurationInHoursAttribute()
    {
        return $this->start_date->diffInHours($this->end_date);
    }

    /**
     * Get duration in days
     */
    public function getDurationInDaysAttribute()
    {
        return $this->start_date->diffInDays($this->end_date) + 1; // +1 to include the start day
    }

    /**
     * Get formatted duration
     */
    public function getFormattedDurationAttribute()
    {
        $days = $this->duration_in_days;
        $hours = $this->duration_in_hours;

        if ($days > 1) {
            return $days . ' hari';
        } elseif ($hours >= 1) {
            return $hours . ' jam';
        } else {
            return $this->start_date->diffInMinutes($this->end_date) . ' menit';
        }
    }

    /**
     * Get main image
     */
    public function getMainImageAttribute()
    {
        return $this->images()->first();
    }

    /**
     * Get main image URL
     */
    public function getMainImageUrlAttribute()
    {
        $mainImage = $this->main_image;
        
        if ($mainImage) {
            return $mainImage->url;
        }

        // Return default image if no image exists
        return asset('tenancy/assets/image/default-event.jpg');
    }

    /**
     * Check if event has images
     */
    public function getHasImagesAttribute()
    {
        return $this->images()->count() > 0;
    }

    /**
     * Get images count
     */
    public function getImagesCountAttribute()
    {
        return $this->images()->count();
    }

    /**
     * Get excerpt from description
     */
    public function getExcerptAttribute($length = 150)
    {
        if (empty($this->description)) {
            return '';
        }

        return Str::limit(strip_tags($this->description), $length);
    }

    /**
     * Get time until event starts
     */
    public function getTimeUntilStartAttribute()
    {
        if ($this->is_past || $this->is_ongoing) {
            return null;
        }

        return $this->start_date->diffForHumans();
    }

    /**
     * Check if event is multi-day
     */
    public function getIsMultiDayAttribute()
    {
        return !$this->start_date->isSameDay($this->end_date);
    }

    /**
     * Get day of week for start date
     */
    public function getStartDayAttribute()
    {
        return $this->start_date->format('l');
    }

    /**
     * Get Indonesian day name for start date
     */
    public function getStartDayIndonesianAttribute()
    {
        $days = [
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu',
        ];

        return $days[$this->start_day] ?? $this->start_day;
    }

    /**
     * Search scope
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%")
              ->orWhere('location', 'like', "%{$search}%")
              ->orWhere('organizer', 'like', "%{$search}%");
        });
    }

    /**
     * Filter by date range
     */
    public function scopeDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('start_date', [$startDate, $endDate]);
    }

    /**
     * Order by start date
     */
    public function scopeOrderByStartDate($query, $direction = 'asc')
    {
        return $query->orderBy('start_date', $direction);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Event extends Model
{

    protected $fillable = [
        'title',
        'description',
        'event_date',
        'image',
    ];

    protected $casts = [
        'event_date' => 'datetime',
    ];

    public function hasPassed()
    {
        return $this->event_date->isPast();
    }

    public function getFormattedDateAttribute()
    {
        return $this->event_date->format('d M Y, H:i');
    }

    public function getStatusAttribute()
    {
        if ($this->hasPassed()) {
            return 'ended';
        }
        
        return 'active';
    }

    public function scopeUpcoming($query)
    {
        return $query->where('event_date', '>=', now());
    }

    public function scopeActive($query)
    {
        return $query->where('event_date', '>=', now());
    }

     public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }

    public function hasImage()
    {
        return !empty($this->image) && Storage::disk('public')->exists($this->image);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class DownloadLimit extends Model
{
    protected $fillable = ['user_id', 'download_count', 'last_download_reset'];
    
    protected $casts = [
        'last_download_reset' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(Pengguna::class);
    }
    
    /**
     * Check if download limit should be reset (new day)
     */
    public function shouldResetToday()
    {
        if (!$this->last_download_reset) {
            return true;
        }
        
        return $this->last_download_reset->format('Y-m-d') !== now()->format('Y-m-d');
    }
}
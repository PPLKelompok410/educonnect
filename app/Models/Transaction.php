<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    protected $fillable = [
        'transaction_id',
        'user_id',
        'payment_id',
        'payment_method',
        'subtotal',
        'admin_fee',
        'tax',
        'total'
    ];

    protected $casts = [
        'subtotal' => 'integer',
        'admin_fee' => 'integer',
        'tax' => 'integer',
        'total' => 'integer',
    ];

    // Relationship with User/Pengguna
    public function pengguna(): BelongsTo
    {
        return $this->belongsTo(Pengguna::class, 'user_id');
    }
    
    // Relationship with Payment
    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }
}
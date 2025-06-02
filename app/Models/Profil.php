<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    protected $table = 'profiles';

    protected $fillable = [
        'pengguna_id',
        'phone_number',
        'address',
        'bio'
    ];

    public $timestamps = true;

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id');
    }
}

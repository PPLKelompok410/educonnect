<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Profil;

class Pengguna extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'penggunas';

    protected $fillable = [
        'full_name',
        'date_of_birth',
        'email',
        'password',
        'gender'
    ];

    public function profile()
    {
        return $this->hasOne(Profil::class, 'pengguna_id');
    }
}

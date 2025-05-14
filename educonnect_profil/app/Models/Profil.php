<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{

    protected $table = 'profiles';

    protected $fillable = [
       'name', 'email', 'phone_number', 'address', 'bio'
    ];

    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

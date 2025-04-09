<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['matkul_id', 'user_id', 'comment'];

    public function matkul()
    {
        return $this->belongsTo(Matkul::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

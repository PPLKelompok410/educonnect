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
        return $this->belongsTo(\App\Models\MataKuliah::class, 'matkul_id');
    }

    public function user()
    {
        return $this->belongsTo(Pengguna::class);
    }
}

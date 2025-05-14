<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'kode', 'prodi', 'gambar', 'deskripsi'];

    public function comments()
    {
        return $this->hasMany(Comment::class, 'matkul_id');
    }

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class);
    }
}
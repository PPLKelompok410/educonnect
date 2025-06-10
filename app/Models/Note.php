<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'judul',
        'deskripsi',
        'matkul_id'
    ];

    public function user()
    {
        return $this->belongsTo(Pengguna::class, 'user_id'); // user_id kolom foreign key ke pengguna.id
    }

    public function comments()
    {
        return $this->hasMany(NoteComment::class);
    }

    public function matkul()
    {
        return $this->belongsTo(MataKuliah::class);
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    public function ratings()
    {
        return $this->hasMany(\App\Models\NoteRating::class);
    }

    public function averageRating()
    {
        return $this->ratings()->avg('rating') ?? 0;
    }

    public function totalReviewer()
    {
        return $this->ratings()->count();
    }

    public function files()
    {
        return $this->hasMany(NoteFile::class);
    }
}

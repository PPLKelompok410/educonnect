<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'pengguna_id',
        'judul',
        'file_path',
        'matkul_id',
    ];

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class);
    }

    public function comments()
    {
        return $this->hasMany(NoteComment::class);
    }

    public function matkul()
{
    return $this->belongsTo(MataKuliah::class);
}
}


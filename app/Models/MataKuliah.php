<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    use HasFactory;

    protected $table = 'mata_kuliahs';

    protected $fillable = ['nama', 'kode', 'prodi', 'gambar', 'deskripsi'];

    /**
     * Relasi: Setiap matkul memiliki banyak komentar.
     * Ini menghubungkan matkul ke tabel comments.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'matkul_id'); // foreign key-nya sesuai
    }

    // Menambahkan relasi dengan user jika diperlukan
    public function user()
    {
        return $this->belongsTo(Pengguna::class);
    }
}

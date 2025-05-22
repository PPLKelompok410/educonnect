<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matkul extends Model
{
    use HasFactory;

    // Daftar kolom yang bisa diisi
    protected $fillable = ['name', 'description'];  // Sesuaikan dengan kolom di tabel matkul

    /**
     * Relasi: Setiap matkul memiliki banyak komentar.
     * Ini menghubungkan matkul ke tabel comments.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class); // Relasi one-to-many dengan Comment
    }

    // Menambahkan relasi dengan user jika diperlukan
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

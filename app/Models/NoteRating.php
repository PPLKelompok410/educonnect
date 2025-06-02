<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoteRating extends Model
{
    use HasFactory;

    protected $fillable = ['note_id', 'user_id', 'rating'];

    public function note()
    {
        return $this->belongsTo(Note::class);
    }

    public function user()
    {
        return $this->belongsTo(Pengguna::class, 'user_id');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoteComment extends Model
{
    use HasFactory;

    protected $fillable = ['note_id', 'pengguna_id', 'content'];

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class);
    }

    public function note()
    {
        return $this->belongsTo(Note::class);
    }
}

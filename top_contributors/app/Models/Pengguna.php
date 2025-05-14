<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengguna extends Model
{
    use HasFactory;

    protected $table = 'penggunas';

    protected $fillable = ['nama', 'email'];

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function noteComments()
    {
        return $this->hasMany(NoteComment::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}

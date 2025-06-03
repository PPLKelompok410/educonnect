<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Profil;
use App\Models\NoteComment;
use App\Models\Comment;
use App\Models\Note;

class Pengguna extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'penggunas';

    protected $fillable = [
        'full_name',
        'date_of_birth',
        'email',
        'password',
        'gender'
    ];

    public function profil()
    {
        return $this->hasOne(Profil::class, 'pengguna_id');
    }

    public function notes()
    {
        return $this->hasMany(Note::class, 'user_id');
    }

    public function noteComments()
    {
        return $this->hasMany(NoteComment::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id');
    }
}

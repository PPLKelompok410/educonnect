<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    protected $fillable = ['user_id', 'note_id'];

    public function user()
    {
        return $this->belongsTo(Pengguna::class);
    }

    public function note()
    {
        return $this->belongsTo(Note::class);
    }
}
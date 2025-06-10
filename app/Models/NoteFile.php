<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NoteFile extends Model
{
    protected $fillable = ['note_id', 'file_path'];

    public function note()
    {
        return $this->belongsTo(Note::class);
    }

    protected static function booted()
    {
        static::deleted(function ($file) {
            $fullPath = public_path($file->file_path); // Rekonstruksi path lengkap
            if (file_exists($fullPath)) {
                unlink($fullPath); // Hapus file dari server
            }
        });
    }
}

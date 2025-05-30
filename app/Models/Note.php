<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Note extends Model
{
    use HasFactory;

    protected $fillable = ['content'];

    protected static function boot()
    {
        parent::boot();

        static::retrieved(function ($note) {
            Log::info('Note retrieved', ['id' => $note->id]);
        });

        static::created(function ($note) {
            Log::info('Note created', ['id' => $note->id]);
        });

        static::deleted(function ($note) {
            Log::info('Note deleted', ['id' => $note->id]);
        });
    }
}

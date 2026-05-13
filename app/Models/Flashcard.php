<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flashcard extends Model
{
    use HasFactory;

    protected $fillable = [
        'flashcard_session_id',
        'session_id',
        'topic',
        'target_language',
        'original_word',
        'translated_word',
        'example_sentence',
    ];

    //Una flashcard pertenece a una sesión.
    public function flashcardSession()
    {
        return $this->belongsTo(FlashcardSession::class, 'flashcard_session_id');
    }
}
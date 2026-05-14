<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $flashcard_session_id
 * @property int $session_id
 * @property string $topic
 * @property string $target_language
 * @property string $original_word
 * @property string $translated_word
 * @property string $example_sentence
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read \App\Models\FlashcardSession $flashcardSession
 */
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
    public function flashcardSession(): BelongsTo
    {
        return $this->belongsTo(FlashcardSession::class, 'flashcard_session_id');
    }
}

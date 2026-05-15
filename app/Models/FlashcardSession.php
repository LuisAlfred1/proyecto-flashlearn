<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $user_id
 * @property string $topic
 * @property string $target_language
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read \App\Models\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Flashcard[] $flashcards
 */
class FlashcardSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'topic',
        'target_language',
    ];

    //Una sesión pertenece a un usuario.
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    //Una sesión tiene muchas flashcards.
    public function flashcards(): HasMany
    {
        return $this->hasMany(Flashcard::class, 'flashcard_session_id');
    }

    //Scope para ordenar por fecha de creación descendente.
    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}

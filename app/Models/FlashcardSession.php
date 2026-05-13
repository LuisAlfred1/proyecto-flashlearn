<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlashcardSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'topic',
        'target_language',
    ];

    //Una sesión pertenece a un usuario.
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //Una sesión tiene muchas flashcards.
    public function flashcards()
    {
        return $this->hasMany(Flashcard::class, 'flashcard_session_id');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Flashcard;
use App\Models\FlashcardSession;
use Illuminate\Http\Request;

class FlashcardSessionController extends Controller
{
    //Guarda una sesión y sus flashcards asociadas al usuario autenticado.
    public function store(Request $request)
    {
        $validated = $request->validate([
            'topic'       => 'required|string|max:100',
            'language'    => 'required|string|max:50',
            'flashcards'  => 'required|array|min:1',
            'flashcards.*.word'        => 'required|string',
            'flashcards.*.translation' => 'required|string',
            'flashcards.*.example'     => 'required|string',
        ]);

        //Se crea la sesión asociada al usuario autenticado.
        $session = FlashcardSession::create([
            'user_id'         => auth()->id(),
            'topic'           => $validated['topic'],
            'target_language' => $validated['language'],
        ]);

        //Se crean las flashcards asociadas a la sesión.
        foreach ($validated['flashcards'] as $item) {
            Flashcard::create([
                'flashcard_session_id' => $session->id,
                'topic'                => $validated['topic'],
                'target_language'      => $validated['language'],
                'original_word'        => $item['word'],
                'translated_word'      => $item['translation'],
                'example_sentence'     => $item['example'],
            ]);
        }

        return response()->json([
            'ok'         => true,
            'message'    => 'Flashcards guardadas correctamente.',
            'session_id' => $session->id,
        ]);
    }

    //Retorna todas las sesiones del usuario autenticado con conteo de tarjetas.
    public function index()
    {
        $sessions = FlashcardSession::where('user_id', auth()->id())
            ->withCount('flashcards')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($session) {
                return [
                    'id'              => $session->id,
                    'topic'           => $session->topic,
                    'target_language' => $session->target_language,
                    'created_at'      => $session->created_at->toDateString(),
                    'flashcards_count' => $session->flashcards_count,
                ];
            });

        return response()->json([
            'ok'       => true,
            'sessions' => $sessions,
        ]);
    }

    //Retorna las flashcards de una sesión específica del usuario autenticado.
    public function show(FlashcardSession $session)
    {
        //Se verifica que la sesión pertenece al usuario autenticado.
        if ($session->user_id !== auth()->id()) {
            return response()->json([
                'ok'      => false,
                'message' => 'No tienes permiso para ver esta sesión.',
            ], 403);
        }

        return response()->json([
            'ok'      => true,
            'session' => [
                'id'              => $session->id,
                'topic'           => $session->topic,
                'target_language' => $session->target_language,
            ],
            'flashcards' => $session->flashcards->map(function ($flashcard) {
                return [
                    'id'               => $flashcard->id,
                    'original_word'    => $flashcard->original_word,
                    'translated_word'  => $flashcard->translated_word,
                    'example_sentence' => $flashcard->example_sentence,
                ];
            }),
        ]);
    }

    //Elimina una sesión y sus flashcards asociadas.
    public function destroy(FlashcardSession $session)
    {
        //Se verifica que la sesión pertenece al usuario autenticado.
        if ($session->user_id !== auth()->id()) {
            return response()->json([
                'ok'      => false,
                'message' => 'No tienes permiso para eliminar esta sesión.',
            ], 403);
        }

        $session->delete();

        return response()->json([
            'ok'      => true,
            'message' => 'Sesión eliminada correctamente.',
        ]);
    }
}
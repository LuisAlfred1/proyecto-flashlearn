<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FlashcardController extends Controller
{
    private array $availableLanguages = [
        'Inglés',
        'Francés',
        'Alemán',
        'Italiano',
        'Portugués',
        'Japonés',
    ];

    public function index()
    {
        return view('pages.flashcards');
    }

    public function generate(Request $request)
    {
        $validated = $request->validate([
            'tema' => 'required|string|max:100',
            'language' => ['required', 'string', Rule::in($this->availableLanguages)],
        ]);

        return response()->json([
            'ok' => true,
            'tema' => $validated['tema'],
            'language' => $validated['language'],
            'idiomas_disponibles' => $this->availableLanguages,
            'flashcards' => [
                [
                    'palabra' => 'variable',
                    'traduccion' => 'variable',
                    'ejemplo' => 'Una variable almacena un valor.'
                ],
                [
                    'palabra' => 'funcion',
                    'traduccion' => 'función',
                    'ejemplo' => 'Una función ejecuta una tarea específica.'
                ],
                [
                    'palabra' => 'bucle',
                    'traduccion' => 'loop',
                    'ejemplo' => 'Un bucle repite instrucciones varias veces.'
                ]
            ]
        ]);
    }
}
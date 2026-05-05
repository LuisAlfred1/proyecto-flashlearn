<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FlashcardController extends Controller
{
    public function index()
    {
        return view('pages.flashcards');
    }

    public function generate(Request $request)
    {
        $validated = $request->validate([
            'tema' => 'required|string|max:100',
            'language' => 'required|string|max:50',
        ]);

        return response()->json([
            'ok' => true,
            'tema' => $validated['tema'],
            'language' => $validated['language'],
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
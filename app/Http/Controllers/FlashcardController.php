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
            'message' => 'respuesta json inicial de prueba',
            'tema' => $validated['tema'],
            'language' => $validated['language']
        ]);
    }
}
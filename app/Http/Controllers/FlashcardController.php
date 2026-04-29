<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FlashcardController extends Controller
{
    public function index()
    {
        //Ahora aqui retorna la vista de flashcards, que se encuentra en resources/views/pages/flashcards.blade.php
        return view('pages.flashcards');
    }

    public function generate(Request $request)
    {
        $validated = $request->validate([
            'tema' => 'required|string|max:100',
            'language' => 'required|string|max:50',
        ]);

        return response()->json([
            'message' => 'Validación correcta',
            'data' => $validated
        ]);
    }
}

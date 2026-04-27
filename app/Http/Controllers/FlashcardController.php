<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FlashcardController extends Controller
{
    public function index()
    {
        return response('FlashLearn backend funcionando');
    }

    public function generate(Request $request)
    {
        return response()->json([
            'message' => 'Método generate funcionando'
        ]);
    }
}
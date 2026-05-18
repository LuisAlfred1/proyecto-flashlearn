<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
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
        'Chino',
    ];

    public function index()
    {
        return view('pages.flashcards');
    }

    public function generate(Request $request)
    {
        $validated = $request->validate([
            'tema' => [
                'required',
                'string',
                'min:3',
                'max:100',
                'regex:/^[\p{L}\p{N}\s\-_.,áéíóúÁÉÍÓÚñÑüÜ]+$/u',
            ],
            'language' => [
                'required', 
                'string', 
                Rule::in($this->availableLanguages)
            ],
        ]);

        $apiKey = env('GEMINI_API_KEY');

        //Se definen los modelos en orden de prioridad. Si uno falla por límite, se intenta con el siguiente.
        $models = [
            'gemini-2.5-flash-lite',
            'gemini-2.5-flash',
            'gemini-3-flash-preview',
        ];

        if (!$apiKey) {
            return response()->json([
                'ok' => false,
                'message' => 'No se encontró la API key de Gemini.'
            ], 500);
        }

        $promptPath = base_path('prompt.txt');

        if (!file_exists($promptPath)) {
            return response()->json([
                'ok' => false,
                'message' => 'No se encontró el archivo prompt.txt.'
            ], 500);
        }

        $promptTemplate = file_get_contents($promptPath);

        $prompt = str_replace(
            ['{{tema}}', '{{idioma}}'],
            [$validated['tema'], $validated['language']],
            $promptTemplate
        );

        //Se intenta con cada modelo hasta que uno responda correctamente.
        $response = null;
        foreach ($models as $model) {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'X-goog-api-key' => $apiKey,
            ])->post(
                "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent",
                [
                    'contents' => [
                        [
                            'parts' => [
                                [
                                    'text' => $prompt
                                ]
                            ]
                        ]
                    ]
                ]
            );

            if ($response->successful()) {
                break;
            }
        }

        if (!$response || !$response->successful()) {
            return response()->json([
                'ok' => false,
                'message' => 'Error al consumir la API generativa.',
                'details' => $response->json()
            ], 500);
        }

        $text = $response->json('candidates.0.content.parts.0.text');

        if (!$text) {
            return response()->json([
                'ok' => false,
                'message' => 'La API no devolvió contenido.'
            ], 500);
        }

        $text = trim($text);
        $text = preg_replace('/^```json\s*|^```\s*|```$/m', '', $text);

        $decoded = json_decode($text, true);

        if (!is_array($decoded)) {
            return response()->json([
                'ok' => false,
                'message' => 'La respuesta de la API no se pudo convertir a JSON.',
                'raw_response' => $text
            ], 500);
        }

        $flashcards = collect($decoded)->map(function ($item) {
            return [
                'word' => $item['word'] ?? '',
                'translation' => $item['translation'] ?? '',
                'example' => $item['example'] ?? '',
            ];
        })->values();

        return response()->json([
            'ok' => true,
            'tema' => $validated['tema'],
            'language' => $validated['language'],
            'idiomas_disponibles' => $this->availableLanguages,
            'flashcards' => $flashcards
        ]);
    }
}
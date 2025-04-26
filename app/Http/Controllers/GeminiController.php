<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\StreamedResponse;

class GeminiController extends Controller
{
    public function handle(Request $request)
    {
        $messages = $request->input('messages', []);
        $language = 'english';

        $filteredMessages = array_filter($messages, function ($msg) use (&$language) {
            if ($msg['role'] === 'system' && str_starts_with($msg['content'], 'LANGUAGE:')) {
                $language = strtolower(trim(explode(':', $msg['content'])[1]));
                return false;
            }
            return true;
        });

        $languageInstruction = [
            'role' => 'model',
            'parts' => [
                [
                    'text' => $language === 'hindi'
                        ? 'आप एक पुरुष सहायक हैं। कृपया हमेशा साधारण, बोलचाल वाली हिंदी में जवाब दें जिसमें ज़रूरत हो तो थोड़ा आसान English मिक्स कर सकते हैं। भाषा ऐसी होनी चाहिए जो आम इंसान आसानी से समझ सके।'
                        : 'You are a male assistant. Always respond in English.'
                ]
            ]
        ];

        $filePath = resource_path('data/surfside_training.txt');

        if (!file_exists($filePath)) {
            return response()->json(['error' => 'Training file not found.'], 500);
        }

        $trainingContent = file_get_contents($filePath);

        // Gemini expects "contents", not "messages" like OpenAI
        $contents = [];

        $contents[] = $languageInstruction;

        $contents[] = [
            'role' => 'user',
            'parts' => [
                ['text' => "About Surfside Media:\n" . $trainingContent]
            ]
        ];

        foreach ($filteredMessages as $msg) {
            $contents[] = [
                'role' => $msg['role'],
                'parts' => [
                    ['text' => $msg['content']]
                ]
            ];
        }

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'x-goog-api-key' => env('GEMINI_API_KEY'),
        ])->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent', [
            'contents' => $contents
        ]);

        $answer = $response->json()['candidates'][0]['content']['parts'][0]['text'] ?? 'Sorry, something went wrong.';

        Cache::put('gemini_last_response', [
            'id' => uniqid(),
            'role' => 'assistant',
            'content' => $answer
        ], now()->addMinutes(1));

        return response()->json([
            'id' => uniqid(),
            'role' => 'system',
            'content' => $answer
        ]);
    }

    public function getLastResponse()
    {
        $data = Cache::get('gemini_last_response');

        if ($data) {
            return response()->json($data);
        }

        return response()->json([
            'error' => 'No response found.'
        ], 500);
    }
}

<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AIController extends Controller
{
    public function chat(Request $request)
    {
        $question = $request->input('question');
        $apiKey   = env('GEMINI_API_KEY');

        try {
            $response = Http::withoutVerifying()
                ->post('https://generativelanguage.googleapis.com/v1/models/gemini-2.5-flash:generateContent?key=' . $apiKey, [
                    'contents' => [
                        [
                            'parts' => [
                                ['text' => $question],
                            ],
                        ],
                    ],
                ]);

            // 429 xatosi – quota tugagan
            if ($response->status() === 429) {
                return response()->json([
                    'content' => [
                        [
                            'text' => "Xatolik! ❌❌❌\n\n" .
                            "Uzur so'rayman.\n" .
                            "Kunlik bepul limit (20 ta savol) tugadi. Google API cheklovi tufayli bugun boshqa javob bera olmayman.\n\n" .
                            "Limitsiz va tezroq javob olish uchun rasmiy AI dan foydalaning 👇\n\n" .
                            "Gemini AI ga o'tish: https://gemini.google.com ✅",
                        ],
                    ],
                ]);
            }

            if ($response->successful()) {
                $result = $response->json();
                $aiText = $result['candidates'][0]['content']['parts'][0]['text'] ?? 'Javob olib bo\'lmadi.';

                return response()->json([
                    'content' => [['type' => 'text', 'text' => $aiText]],
                ]);
            }

            // Boshqa xatolar (masalan, 500, 400)
            return response()->json([
                'content' => [['type' => 'text', 'text' => 'Texnik xatolik yuz berdi. Keyinroq urinib ko\'ring.']],
            ], 400);

        } catch (\Exception $e) {
            return response()->json([
                'content' => [['type' => 'text', 'text' => 'Server bilan bog\'lanib bo\'lmadi. Internetni tekshiring yoki keyinroq urinib ko\'ring.']],
            ], 500);
        }
    }
}

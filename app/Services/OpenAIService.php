<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class OpenAIService
{
    public function processQuery(string $query): ?array
    {
        $response = Http::withToken(env('OPENAI_API_KEY'))
            ->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-4',
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => "You are a product search assistant. Convert user queries into a JSON format with these keys:
- keywords: string of space-separated words
- category: string or null
- min_price: integer or null
- max_price: integer or null

Return only a valid JSON. No extra text.",
                    ],
                    [
                        'role' => 'user',
                        'content' => $query,
                    ],
                ],
                'temperature' => 0.2,
            ]);

        $result = $response->json();
        $content = $result['choices'][0]['message']['content'] ?? null;

        return json_decode($content, true);
    }
}

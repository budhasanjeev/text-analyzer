<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Http;

class AnalyzeService
{
    public function analyze(array $words): array
    {
        $output = [];
        $service = app(DictionaryService::class);
        foreach ($words as $word) {
            $output[$word] = [
                'en_translations' => '',
                'is_in_db' => $service->vocabExists($word),
            ];

            $response = Http::acceptJson()
                ->get(config('jihso.api_url'), [
                    'keyword' => $word
                ]);

            if ($response->successful()) {
                $output[$word]['en_translations'] = $response->collect()->get('data')[0]['senses'][0]['english_definitions'] ?? '-';
            }
        }

        return $output;
    }
}
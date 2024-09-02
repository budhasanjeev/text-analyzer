<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Dictionary;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class DictionaryService
{
    public function vocabExists(string $word): bool
    {
        return Dictionary::where('jp_word', $word)->exists();
    }

    public function addVocab(array $words): void
    {
        DB::beginTransaction();
        try {
            Dictionary::create([
                'jp_word' => $words[0],
                'en_translation' => $words[1] ?? '',
            ])
            ->save();

            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            Log::error('Failed to add vocab: ' . $e->getMessage());
            throw $e;
        }
    }

    public function updateVocab(string $word): void
    {
        DB::beginTransaction();
        try {
            Dictionary::where('jp_word', $word)
                ->update(['en_translation' => $word]);

            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            Log::error('Failed to update vocab: ' . $e->getMessage());
            throw $e;
        }
    }

    public function removeVocab(string $word): void
    {
        DB::beginTransaction();
        try {
            Dictionary::where('jp_word', $word)
                ->update([Dictionary::DELETED_FLAG => 1]);

            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            Log::error('Failed to remove vocab: ' . $e->getMessage());
            throw $e;
        }
    }

    public function getAll(): array
    {
        return Dictionary::all()->toArray();
    }

    public function getRandomDataByCount(int $count): array
    {
        return Dictionary::inRandomOrder()->limit($count)->get()->toArray();
    }

    public function isQuizEnable(): bool
    {
        return Dictionary::count() >= 4;
    }
}
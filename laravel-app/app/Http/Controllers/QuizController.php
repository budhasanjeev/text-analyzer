<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\DictionaryService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Throwable;

class QuizController extends Controller
{
    public function index()
    {
        try {
            $service = app(DictionaryService::class);
            $words = $service->getRandomDataByCount(4);

            $data = [
                'question' => $words[0]['jp_word'],
                'answer' => $words[0]['en_translation'],
            ];

            foreach ($words as $key => $word) { 
                $data['options'][] = $word['en_translation']; 
            }

            shuffle($data['options']);

            return view('quiz', $data);
        } catch (Throwable $e) {
            throw $e;
        }       
    }
}
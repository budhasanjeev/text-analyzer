<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\DictionaryService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Throwable;

class DictionaryController extends Controller
{
    public function index()
    {
        try {
            $service = app(DictionaryService::class);
            $words = $service->getAll();

            return view('dictionary', ['words' => $words]);
        } catch (Throwable $e) {
            throw $e;
        }       
    }

    public function addVocab(Request $request)
    {
        $validator = Validator::make(
            $request->all(), 
            [
                'word' => ['bail', 'required', 'string'],
            ], 
            [
                'word.required' => 'Input is required.',
                'word.string' => 'The input must be a string.',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'error' => $validator->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $jpEnWord = explode(':', $request->input('word'));
            $service = app(DictionaryService::class);

            if ($service->vocabExists($jpEnWord[0]) === false) {
                $service->addVocab($jpEnWord);
            } else {
                $service->updateVocab($jpEnWord[1] ?? '');
            }

            return response()->json(['is_quiz_enable' =>  $service->isQuizEnable()], 201);
        } catch (Throwable $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function removeVocab(Request $request)
    {
        $validator = Validator::make(
            $request->all(), 
            [
                'word' => ['bail', 'required', 'string'],
            ], 
            [
                'word.required' => 'Input is required.',
                'word.string' => 'The input must be a string.',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'error' => $validator->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $jpEnWord = explode(':', $request->input('word'));
            $service = app(DictionaryService::class);

            $service->removeVocab($jpEnWord[0]);

            return response()->json(['is_quiz_enable' =>  $service->isQuizEnable()], 200);
        } catch (Throwable $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
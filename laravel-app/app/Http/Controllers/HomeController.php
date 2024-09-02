<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\AnalyzeService;
use App\Services\DictionaryService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Throwable;

class HomeController extends Controller
{
    public function index()
    {
        $service = app(DictionaryService::class);
        return view('home', ['is_quiz_enable' =>  $service->isQuizEnable()]);
    }

    public function analyze(Request $request)
    {
        $validator = Validator::make(
            $request->all(), 
            [
                'words' => ['bail', 'required', 'array']
            ], 
            [
                'words.required' => 'Inputs are required.',
                'words.array' => 'The inputs must be an array.',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'error' => $validator->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $service = app(AnalyzeService::class);
            $data = $service->analyze($request->input('words'));

            return response()->json([
                'success' => true,
                'data' => $data,
            ]);
        } catch (Throwable $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
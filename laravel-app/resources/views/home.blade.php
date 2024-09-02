@extends('layouts')

@section('title', 'Home')

@section('header-navs')
    <div class="btn-group">
        <i class="my-vocabs"><a href="/dictionary">My Vocabulary</a></i>

        @if($is_quiz_enable)
        <i class="btn-quiz"><a href="/quiz">Quiz</a></i>
        @endIf
    </div>
@endSection

@section('content')
    <div class="container">
        <div class="div-input">
            <textarea placeholder="Type here ..."></textarea>
            <button class="btn-analyze">Analyze</button>
        </div>
        
        <div class="div-output">
        </div>
    </div>

    <div class="loading-overlay">
        <div class="spinner"></div>
    </div>
@endSection
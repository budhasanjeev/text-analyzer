@extends('layouts')

@section('title', 'My Vocabulary')

@section('header-navs')
<i class="home"><a href="/">Home</a></i>
@endSection

@section('content')
    <div class="container">
        <div class="quiz">
            <h2>What is the meaning of "{{ $question}}"?</h2>

            <div class="options">
            @foreach ($options as $option)
                <li>
                    <input type="radio" name="select-answer" value="{{ $option }}">{{ $option }}</input>
                </li>
            @endforeach
            </div>

            <button class="btn-submit" >Submit</button>
            <button class="btn-refresh" >Refresh</button>
        </div>

        <div class="div-output">
        </div>
        
        <input type="hidden" class="answer" value="{{ $answer }}">
    </div>

    <div class="loading-overlay">
        <div class="spinner"></div>
    </div>
@endSection
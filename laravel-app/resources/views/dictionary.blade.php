@extends('layouts')

@section('title', 'My Vocabulary')

@section('header-navs')
<i class="home"><a href="/">Home</a></i>
@endSection

@section('content')
    <div class="container">
        <table class="table"> 
            <thead>
                <th>jp word</th>
                <th>en translations</th>
                <th>registered datetime</th>
            </thead>
           
            @foreach ($words as $word)
                <tr>
                    <td>{{ $word['jp_word'] }}</td>
                    <td>{{ $word['en_translation'] }}</td>
                    <td>{{ $word['created_at'] }}</td>
                </tr>
            @endforeach
        </table>
    </div>

    <div class="loading-overlay">
        <div class="spinner"></div>
    </div>
@endSection
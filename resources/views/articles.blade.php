@extends('layouts.app')

@section('title', 'Users')


@section('content')
    @foreach ($articles as $article)
        <div class="p-4">
            <a href="/article/{{ $article->id }}">{{ $article->title }}</a>
        </div>
    @endforeach

@endsection

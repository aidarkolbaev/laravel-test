@extends('layouts.app')

@section('title', $article->title)


@section('content')
    <div class="px-6 py-2 max-w-2xl mx-auto">
        <div class="p-3 my-4 bg-white shadow-md shadow rounded">
            <div class="text-lg text-teal-500">{{ $article->title }}</div>
            <div class="my-2 break-all p-2 rounded bg-gray-100">
                {!! $article->content !!}
            </div>
            <div class="flex justify-between mt-4">
                <div class="text-xs text-gray-600">
                    <span class="material-icons text-xs mr-1">calendar_today</span>
                    {{ date('H:i, j M', strtotime($article->created_at)) }}
                </div>
                @auth
                    @if(Auth::user()->id === $article->user->id)
                        <div class="flex">
                            <a href="/article/{{ $article->id }}/edit" class="mr-4">
                                <div class="text-xs text-teal-500">Редактировать</div>
                            </a>
                            <a href="/article/{{ $article->id }}/delete">
                                <div class="text-xs text-red-500">Удалить</div>
                            </a>
                        </div>
                    @endif
                @endauth
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('title', $article->title)


@section('content')
    <div class="px-6 py-2 max-w-2xl mx-auto">
        <div class="p-3 my-4 bg-white shadow rounded">
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
        @if(count($article->articles) > 0)
            <div class="mt-12 text-center text-gray-600">Читайте также:</div>
            <div class="flex flex-wrap justify-center">
                @foreach($article->articles as $linkedArticle)
                    <a href="/article/{{ $linkedArticle->id }}" class="mx-2">
                        <div class="bg-white py-2 px-3 text-sm rounded-md mt-2 shadow">
                            <div class="text-teal-500">{{ $linkedArticle->title }}</div>
                            <div class="bg-teal-200 rounded p-1 text-xs text-teal-600 my-2 flex items-center justify-center">
                                <div class="mr-1">Читать</div>
                                <span class="material-icons font-bold text-xs">arrow_forward_ios</span>
                            </div>
                            <div class="text-xs text-gray-600">
                                <span class="material-icons text-xs mr-1">calendar_today</span>
                                {{ date('H:i, j M', strtotime($linkedArticle->created_at)) }}
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
@endsection

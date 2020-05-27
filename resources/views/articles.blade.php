@extends('layouts.app')

@section('title', 'Статьи')


@section('content')
    <div class="px-6 py-2 max-w-2xl mx-auto">
        @foreach ($articles as $article)
            <div class="p-3 my-4 bg-white shadow rounded">
                <a href="/article/{{ $article->id }}">
                    <div class="text-lg text-teal-500">{{ $article->title }}</div>
                </a>
                <div class="my-2 break-all p-2 rounded bg-gray-100">
                    {!! $article->content !!}
                </div>
                <div class="flex justify-between mt-4">
                    <div class="text-xs text-gray-600">
                        <span class="material-icons text-xs mr-1">calendar_today</span>
                        {{ date('H:i, j M', strtotime($article->created_at)) }}
                    </div>
                    <a href="/article/{{ $article->id }}">
                        <div class="text-xs text-teal-500">Читать</div>
                    </a>
                </div>
            </div>
        @endforeach
        <div class="my-6 text-center max-w-2xl overflow-x-auto">
            @for($i = 1; $i <= $pages; $i++)
                <div class="inline-block mx-2 {{ $currentPage === $i ? 'text-lg text-teal-600' : '' }}">
                    <a href="?page={{ $i }}">{{ $i }}</a>
                </div>
            @endfor
        </div>
    </div>
@endsection

@extends('layouts.article-form')

@section('title', 'Редактирование статьи')
@section('form-title', 'Редактирование статьи')
@section('form-action', '/article/' . $article->id . '/edit')
@section('article-title', $article->title)
@section('article-content', $article->content)

@section('javascript')
    @parent
    <script>
        if (linkedArticles) {
            linkedArticles = @json($article->articles);
            refreshArticlesList();
            refreshArticlesField();
        }
    </script>
@endsection

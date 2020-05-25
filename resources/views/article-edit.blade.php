@extends('layouts.article-form')

@section('title', 'Редактирование статьи')
@section('form-title', 'Редактирование статьи')
@section('form-action', '/article/' . $article->id . '/edit')
@section('article-title', $article->title)
@section('article-content', $article->content)

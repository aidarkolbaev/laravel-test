@extends('layouts.app')

@section('title', 'Авторизация')

@section('content')
    <div class="flex justify-center items-center w-full h-full">
        <div class="p-4 border border-gray-300">
            <form method="post" class="login-form" action="/login">
                @csrf
                <div class="form-row">
                    <label class="form-label" for="username">Имя:</label>
                    <div><input class="form-field" type="text" name="username" id="username"></div>
                </div>
                <div class="form-row">
                    <label class="form-label" for="password">Имя:</label>
                    <div><input class="form-field" type="text" name="password" id="password"></div>
                </div>
                <div class="form-row">
                    <div class="align-right">
                        <button type="submit" class="btn btn-blue">Войти</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="flex justify-center items-center w-full h-full">
        <div class="p-6 shadow-lg rounded bg-white">
            <div class="text-center text-lg">@yield('form-title')</div>
            @if ($errors->any())
                <div class="bg-red-300 text-red-800 px-4 py-2 text-sm my-4">
                    {{ $message }}
                </div>
            @endif
            <form method="post" action="@yield('form-action')">
                @csrf
                <div class="mt-4">
                    <label class="block" for="username">Имя:</label>
                    <div>
                        <input class="w-full bg-gray-100 p-1" autocomplete="none" type="text" name="username" id="username">
                    </div>
                </div>
                <div class="mt-4">
                    <label class="block" for="password">Пароль:</label>
                    <div>
                        <input class="w-full bg-gray-100 p-1" type="password" name="password" id="password">
                    </div>
                </div>
                <div class="mt-4">
                    <div class="text-right">
                        <button type="submit" class="px-2 py-1 bg-teal-500 text-white rounded text-sm">Отправить</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

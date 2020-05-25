@extends('layouts.app')


@section('content')
    <div class="px-6 py-2 max-w-2xl mx-auto">
        <div class="p-3 my-4 bg-white shadow-md shadow rounded w-full">
            <div class="text-center text-lg">@yield('form-title')</div>
            @if($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="bg-red-300 text-red-800 px-4 py-2 rounded text-sm my-4">
                        {{ $error }}
                    </div>
                @endforeach
            @endif
            <form method="post" action="@yield('form-action')"
                  id="article-form">
                @csrf
                <div class="mt-4">
                    <label class="block" for="title">Заголовок</label>
                    <div>
                        <input class="w-full bg-gray-100 p-1"
                               value="@yield('article-title')" autocomplete="none" type="text" name="title" id="title">
                    </div>
                </div>
                <div class="mt-4">
                    <label class="block" for="content">Содержимое</label>
                    <div>
                        <textarea class="w-full bg-gray-100 p-1" name="content" id="content">
                            @yield('article-content')
                        </textarea>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="text-right">
                        <button type="submit" class="px-2 py-1 bg-teal-500 text-white rounded text-sm">Сохранить
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('javascript')
    <script src="https://cdn.ckeditor.com/ckeditor5/19.0.0/classic/ckeditor.js"></script>
    <script>
        let options = {
            toolbar: ['bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote']
        };
        ClassicEditor.create(document.querySelector('#content'), options)
            .then((e) => {
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection

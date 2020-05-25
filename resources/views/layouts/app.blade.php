<!doctype html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{ asset('css/tailwind.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <style>
        ::-webkit-scrollbar {
            width: 7px;
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #38b2ac;
            border-radius: 7px;
        }
    </style>
    @yield('styles')
    <title>@yield('title')</title>
</head>
<body class="h-full w-full bg-gray-100 pt-12 relative">

<div class="fixed top-0 bg-white w-full z-30 shadow-sm">
    <div class="px-6 max-w-2xl py-3 flex justify-between items-center mx-auto">
        <span class="material-icons cursor-pointer" onclick="toggleMenu()">menu</span>
    </div>
</div>

@yield('content')

<div class="fixed w-full top-0 left-0 h-full z-40 transition-all duration-300 hide" id="menu">
    <div class="absolute h-full w-full bg-black bg-opacity-25" onclick="toggleMenu()"></div>
    <div class="bg-white h-full shadow-md absolute left-0 p-4 px-8 md:px-16">
        <div class="mt-2 flex hover:text-teal-600">
            <span class="material-icons mr-2">list_alt</span>
            <a href="/">Все статьи</a>
        </div>
        @auth
            <div class="mt-2 flex hover:text-teal-600">
                <span class="material-icons mr-2">add_circle_outline</span>
                <a href="/article">Создать статью</a>
            </div>
            <div class="mt-2 flex hover:text-teal-600">
                <span class="material-icons mr-2">exit_to_app</span>
                <a href="/logout">Выйти</a>
            </div>
        @endauth
        @guest
            <div class="mt-2 flex hover:text-teal-600">
                <span class="material-icons mr-2">person</span>
                <a href="/login">Авторизация</a>
            </div>
            <div class="mt-2 flex hover:text-teal-600">
                <span class="material-icons mr-2">person_add</span>
                <a href="/register">Регистрация</a>
            </div>
        @endguest
    </div>
</div>

</body>
<script src="{{ asset('js/app.js') }}"></script>
<script>
    function toggleMenu() {
        let menu = document.getElementById('menu');
        if (menu) {
            let isOpen = !(menu.classList.contains('hide'));
            if (isOpen) {
                document.body.classList.remove('overflow-hidden');
                menu.classList.add('hide');
            } else {
                document.body.classList.add('overflow-hidden');
                menu.classList.remove('hide');
            }
        }
    }
</script>
@yield('javascript')
</html>

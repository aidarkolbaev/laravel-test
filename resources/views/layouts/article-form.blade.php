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
                               value="@yield('article-title')" autocomplete="off" type="text" name="title" id="title">
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
                    <label class="block" for="tags">Тэги (через запятую)</label>
                    <div>
                        <input class="w-full bg-gray-100 p-1"
                               value="@yield('article-tags')" autocomplete="off" type="text" name="tags" id="tags">
                    </div>
                </div>
                <div class="mt-4">
                    <label class="block" for="search">Привязка статей</label>
                    <div class="relative">
                        <input
                            class="w-full bg-gray-100 p-1"
                            onkeyup="searchArticles(this)"
                            type="text"
                            autocomplete="off"
                            placeholder="Введите заголовок статьи..."
                            id="search"
                        >
                        <div
                            class="result absolute border top-0 overflow-hidden rounded hidden mt-10 w-full bg-white shadow-lg"
                            id="search_result">
                        </div>
                        <div id="articles_list"></div>
                        <input type="hidden" name="articles" id="articles">
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
        ClassicEditor.create(document.querySelector('#content'), options);


        let searchTimeout;
        let searchResult = document.getElementById('search_result');

        function searchArticles(elem) {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(function () {
                let search = elem.value.trim();
                if (search.length >= 1) {
                    searchResult.innerHTML = '';
                    axios.get('/articles', {params: {title: search}})
                        .then((res) => {
                            if (res.data && res.data.length) {
                                res.data.forEach(function (article, index) {
                                    let elem = document.createElement('div');
                                    elem.className = 'result p-2 text-sm border-b cursor-pointer hover:bg-gray-200';
                                    if (isLinkedArticleExists(article.id)) {
                                        elem.classList.add('bg-teal-100')
                                    }
                                    elem.innerText = article.title;
                                    elem.setAttribute('data-article-id', article.id);
                                    searchResult.append(elem)
                                })
                            } else {
                                searchResult.innerHTML = '<div class="p-2 text-sm">Не найдено...</div>'
                            }
                            searchResult.classList.remove('hidden');
                        })
                        .catch((err) => {
                            searchResult.innerHTML = '<div class="p-2 text-sm">Не найдено...</div>';
                            searchResult.classList.remove('hidden');
                        })
                }
            }, 1000);
        }


        let linkedArticles = [];
        let articlesList = document.getElementById('articles_list');
        let articlesField = document.getElementById('articles');

        function addLinkedArticle(article) {
            linkedArticles.push(article);
            refreshArticlesList();
            refreshArticlesField();
        }

        function removeLinkedArticle(id) {
            let index = linkedArticles.findIndex((article) => article.id === id);
            if (index !== -1) {
                linkedArticles.splice(index, 1);
                refreshArticlesList();
                refreshArticlesField();
            }
        }

        function isLinkedArticleExists(id) {
            return linkedArticles.findIndex((article) => article.id === id) !== -1
        }

        function refreshArticlesList() {
            articlesList.innerHTML = '';
            linkedArticles.forEach(function (article, index) {
                let articleElem = document.createElement('div');
                articleElem.className = 'inline-block p-1 text-xs mt-1 mr-2 bg-gray-200 rounded-md';
                articleElem.setAttribute('data-article-id', article.id);
                articleElem.innerHTML = article.title;
                articleElem.onclick = function (event) {
                    removeLinkedArticle(article.id)
                };
                articlesList.append(articleElem);
            })
        }

        function refreshArticlesField() {
            let articleIds = [];
            linkedArticles.forEach(function (article, index) {
                articleIds.push(article.id);
            });
            articlesField.value = articleIds.join(',')
        }

        document.addEventListener('click', function (event) {
            let elem = event.target;
            if (elem.classList.contains('result')) {
                let article = {id: parseInt(elem.getAttribute('data-article-id')), title: elem.innerText};
                if (isLinkedArticleExists(article.id)) {
                    removeLinkedArticle(article.id)
                } else {
                    addLinkedArticle(article)
                }
            } else if (!searchResult.classList.contains('hidden')) {
                searchResult.classList.add('hidden');
            }
        })

    </script>
@endsection

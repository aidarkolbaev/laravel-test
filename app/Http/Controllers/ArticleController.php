<?php

namespace App\Http\Controllers;

use App\Article;
use App\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ArticleController extends Controller
{

    /**
     * Display a listing of the articles.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request)
    {
        $page = (int)$request->query('page', 1);
        $limit = 10;
        $offset = ($page - 1) * $limit;
        $pages = ceil(Article::query()->count() / $limit);
        $articles = Article::query()->orderByDesc('updated_at')->offset($offset)->limit($limit)->get();
        return view('articles', ['articles' => $articles, 'pages' => $pages, 'currentPage' => $page]);
    }

    /**
     * Show one article
     * @param $id int
     * @return Factory|RedirectResponse|Redirector|View
     */
    public function show($id)
    {
        $article = Article::findOrFail($id);
        if (!$article) {
            return redirect('/');
        }
        return view('article', ['article' => $article]);
    }

    /**
     * Create article
     *
     * @param Request $request
     * @return RedirectResponse|Redirector|View
     */
    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->validate([
                'title' => 'required|max:255',
                'content' => 'required'
            ]);
            $article = new Article($data);
            Auth::user()->articles()->save($article);
            return redirect('/');
        }
        return view('article-create');
    }

    /**
     * Edit article
     *
     * @param $id int
     * @param Request $request
     * @return RedirectResponse|Redirector|View
     */
    public function edit($id, Request $request)
    {
        /** @var Article $article */
        $article = Article::findOrFail($id);
        if ($article->user->id !== Auth::id()) {
            return redirect('/article/' . $id);
        }
        if ($request->isMethod('post')) {

            $data = $request->validate([
                'title' => 'required|max:255',
                'content' => 'required'
            ]);
            /** @var Article $article */
            $article->update($data);

            return redirect('/article/' . $id);
        }
        return view('article-edit', ['article' => $article]);
    }


    /**
     * Delete article by id
     *
     * @param $id
     * @param User $user
     * @return RedirectResponse|Redirector
     */
    public
    function delete($id, User $user)
    {
        /** @var Article $article */
        $article = Article::findOrFail($id);
        if ($article->user->id === Auth::id()) {
            Article::destroy($id);
        }
        return redirect('/');
    }
}

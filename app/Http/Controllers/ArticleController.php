<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
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
     * @param $id int
     * @return Factory|View
     */
    public function show($id) {
        $article = Article::find($id);
        return view('article', ['article' => $article]);
    }

    /**
     * Create article
     *
     * @param Request $request
     * @return RedirectResponse|Redirector|View
     */
    public function create(Request $request) {
        if ($request->isMethod('post')) {
            $data = $request->validate([
                'title' => 'required|max:255',
                'content' => 'required'
            ]);
            $user = new Article($data);
            $user->save();
            return redirect('/');
        }
        return view('article-create');
    }
}

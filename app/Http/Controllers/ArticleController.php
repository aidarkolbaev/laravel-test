<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request)
    {
        $page = (int)$request->query('page', 1);
        $limit = 10;
        $offset = ($page - 1) * $limit;
        $articlesNum = Article::query()->count();
        $articles = Article::query()->offset($offset)->limit($limit)->get();
        return view('articles', ['articles' => $articles, 'articlesNum' => $articlesNum]);
    }
}

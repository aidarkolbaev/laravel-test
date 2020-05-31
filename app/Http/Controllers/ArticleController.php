<?php

namespace App\Http\Controllers;

use App\Article;
use App\Tag;
use App\User;
use Composer\Package\Package;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
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
                'content' => 'required',
                'articles' => 'string|nullable',
                'tags' => 'string|nullable'
            ]);
            $article = new Article($data);
            $articles = explode(',', $data['articles']);
            foreach ($articles as $articleId) {
                if (is_numeric($articleId)) {
                    $article->articles()->attach((int)$articleId);
                }
            }

            $tags = explode(',', $data['tags']);
            if (count($tags)) {
                $tagModels = [];
                foreach ($tags as $tag) {
                    if (is_string($tag)) {
                        $tagModels[] = Tag::firstOrNew(['name' => trim($tag)]);
                    }
                }
                $article->tags()->saveMany($tagModels);
            }


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
                'content' => 'required',
                'articles' => 'string|nullable',
                'tags' => 'string|nullable'
            ]);
            $article->articles()->detach();
            $articles = explode(',', $data['articles']);
            foreach ($articles as $articleId) {
                if (is_numeric($articleId)) {
                    $article->articles()->attach((int)$articleId);
                }
            }

            $article->tags()->detach();
            $tags = explode(',', $data['tags']);
            if (count($tags)) {
                $tagModels = [];
                foreach ($tags as $tag) {
                    if (is_string($tag)) {
                        $tagModels[] = Tag::firstOrNew(['name' => trim($tag)]);
                    }
                }
                $article->tags()->saveMany($tagModels);
            }

            $article->update($data);
            return redirect('/article/' . $id);
        }
        $tags = [];
        /** @var Tag $tag */
        foreach ($article->tags as $tag) {
            $tags[] = $tag->name;
        }
        return view('article-edit', ['article' => $article, 'tags' => $tags]);
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

    /**
     * @param Request $request
     * @return Builder[]|Collection
     */
    public function search(Request $request)
    {
        $title = $request->query('title', null);
        if (!$title) {
            return [];
        }
        return Article::query()
            ->where('title', 'like', '%' . $title . '%')
            ->limit(20)
            ->get();
    }
}

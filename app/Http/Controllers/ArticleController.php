<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index() {
        $articles = Article::with('tagged')->get();
        $tags = Article::existingTags();

        return view('article', compact('articles', 'tags'));
    }

    public function store(Request $request) {
        $this->validate($request, [
           'title' => 'required',
           'body' => 'required',
           'tags' => 'required'
        ]);

        $article = Article::create([
           'title' => $request->title,
           'body' => $request->body
        ]);

        $tags = explode(',', $request->tags);
        $article->tag($tags);

        return redirect()->back()->with('success', 'Article created');
    }

    public function untag($article_id, $tag) {
        $article = Article::find($article_id);

        $article->untag($tag);

        return redirect()->back();
    }

    public function getArticleByTag($tag) {
        $articles = Article::withAnyTag($tag)->get();

        return view('articleByTag',  compact('articles'));
    }
}

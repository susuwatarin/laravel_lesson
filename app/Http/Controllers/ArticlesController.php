<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Article;
use App\Http\Requests\ArticleRequest;
use Carbon\Carbon;


class ArticlesController extends Controller
{
  public function index()
  {
    $articles = Article::orderBy('published_at', 'desc')->published()->get();
    return view('articles.index', compact('articles'));
  }
 
  public function show($id)
  {
    $article = Article::findOrFail($id);
    return view('articles.show', compact('article'));
  }

  public function create()
  {
    return view('articles.create');
  }

  // public function store()
  // {
  //   $inputs = \Request::all();
  //   Article::create($inputs);
  //   return redirect('articles');
  // }

  public function store(ArticleRequest $request)
  {
    Article::create($request->all());
    return redirect('articles');
  }

}

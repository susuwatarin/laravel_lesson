<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Article;
use App\Http\Requests\ArticleRequest;
use Carbon\Carbon;


class ArticlesController extends Controller
{
  public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    
  /***************************
  記事一覧ページ表示
    ・DBのArticlesテーブルからデータを抜き、$articlesに配列として入力
    ・VIEWのarticles.indexに配列データを送る。
  ***************************/
  public function index()
  {
    $articles = Article::orderBy('published_at', 'desc')->published()->get();
    return view('articles.index', compact('articles'));
  }

  /***************************
  単一記事ページ表示
    ・DBのArticlesテーブルから$idを引数としてデータを抜き、$articleに$idのデータを入力
    ・0件だった場合に備えてfindOrFailでデータを抜く
    ・VIEWのarticles.showに$idの$articleデータを送る。
  ***************************/ 
  public function show($id)
  {
    $article = Article::findOrFail($id);
    return view('articles.show', compact('article'));
  }

  /***************************
  新記事作成ページ表示
    ・データベースからは何も送らない
    ・VIEWのarticles.createを見る
  ***************************/
  public function create()
  {
    return view('articles.create');
  }

  /***************************
  新記事作成（POSTの関数）
    ・ArticleRequest関数（記事作成ルール関数）を、引数$requestにとってくる
    ・$requestの中身（ArticleRequest関数）を全て参照して、DBのArticleテーブルへデータ追加処理をする
    ・ページを「/articles」にredirectする
  ***************************/
  public function store(ArticleRequest $request)
  {
    // Article::create($request->all());
    \Auth::user()->articles()->create($request->all());
    \Flash::success("New Article created.");

    return redirect()->route('articles.index');
  }

  /***************************
  記事編集ページ表示
    ・DBのArticlesテーブルから$idを引数としてデータを抜き、$articleに$idのデータを入力
    ・0件だった場合に備えてfindOrFailでデータを抜く
    ・VIEWのarticles.editに$idの$articleデータを送る。
  ***************************/
  public function edit($id)
  {
    $article = Article::findOrFail($id);
    return view('articles.edit', compact('article'));
  }

  /***************************
  記事編集（PATCHの関数）
    ・引数$idで記事（編集したい）idを取ってくる
    ・ArticleRequest関数（記事作成ルール関数）を、引数$requestにとってくる
    ・DBのArticlesテーブルから$idを引数としてデータを抜き、$articleに$idのデータを入力
    ・0件だった場合に備えてfindOrFailでデータを抜く
    ・$requestの中身（ArticleRequest関数）を全て参照して、DBのArticleテーブルへデータ上書き処理をする
    ・ページを「/articles/編集した記事id」にredirectする
  ***************************/
  public function update($id, ArticleRequest $request)
  {
    $article = Article::findOrFail($id);
    $article->update($request->all());
    \Flash::success("{$article->title} updated.");

    return redirect()->route('articles.show', [$article->id]);
  }
  /***************************
  記事削除
    ・DBのArticlesテーブルから$idを引数としてデータを抜き、$articleに$idのデータを入力
    ・0件だった場合に備えてfindOrFailでデータを抜く
    ・$articleをデリート処理
    ・ページを「/articles」にredirectする
  ***************************/
  public function destroy($id)
  {
    $article = Article::findOrFail($id);
    $article->delete();
    \Flash::success("{$article->title} deleted.");

    return redirect()->route('articles.index');
  }

}

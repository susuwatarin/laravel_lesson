<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Article;
use App\Tag;
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
  public function show(Article $article)
  {
    return view('articles.show', compact('article'));
  }

  /***************************
  新記事作成ページ表示
    ・データベースからは何も送らない
    ・VIEWのarticles.createを見る
    ---
    ・tagsにtag（nameとid）の配列を入れる
  ***************************/
  public function create()
  {
    $tags = Tag::lists('name', 'id');
    return view('articles.create', compact('tags'));
  }

  /***************************
  新記事作成（POSTの関数）
    ・ArticleRequest関数（記事作成ルール関数）を、引数$requestにとってくる
    ・ArticleRequest関数を全て参照して、$requestの中にデータを入れ、DBのArticleテーブルへ追加処理をする
    ・ページを「/articles」にredirectする
    ---
    ・$requestで渡されるtag_listをattach()メソッドでタグのリレーションに追加
  ***************************/
  public function store(ArticleRequest $request)
  {
    // Article::create($request->all());
    $article = \Auth::user()->articles()->create($request->all());
    $article->tags()->attach($request->input('tag_list'));

    // \Session::flash('flash_message', 'New Article has been created.');
    \Flash::success("[ {$request->title} ]   has been created.");

    return redirect('articles');
  }

  /***************************
  記事編集ページ表示
    ・DBのArticlesテーブルから$idを引数としてデータを抜き、$articleに$idのデータを入力
    ・0件だった場合に備えてfindOrFailでデータを抜く
    ・VIEWのarticles.editに$idの$articleデータを送る。
    ---
    ・tagsにtag（nameとid）の配列を入れる
  ***************************/
  public function edit(Article $article)
  {
    $tags = Tag::lists('name', 'id');

    return view('articles.edit', compact('article', 'tags'));
  }

  /***************************
  記事編集（PATCHの関数）
    ・引数$idで記事（編集したい）idを取ってくる
    ・ArticleRequest関数（記事作成ルール関数）を、引数$requestにとってくる
    ・DBのArticlesテーブルから$idを引数としてデータを抜き、$articleに$idのデータを入力
    ・0件だった場合に備えてfindOrFailでデータを抜く
    ・$requestの中身（ArticleRequest関数）を全て参照して、DBのArticleテーブルへデータ上書き処理をする
    ・ページを「/articles/編集した記事id」にredirectする
    ---
    ・$requestで渡されるtag_listをsync()メソッドでタグのリレーションに同期
  ***************************/
  public function update(Article $article, ArticleRequest $request)
  {
    $article->update($request->all());
    $article->tags()->sync($request->input('tag_list', []));

    \Flash::success("[ {$article->title} ]   has beens updated.");

    return redirect()->route('articles.show', [$article->id]);
  }
  
  /***************************
  記事削除
    ・DBのArticlesテーブルから$idを引数としてデータを抜き、$articleに$idのデータを入力
    ・0件だった場合に備えてfindOrFailでデータを抜く
    ・$articleをデリート処理
    ・ページを「/articles」にredirectする
  ***************************/
  public function destroy(Article $article)
  {
    $article->delete();
    \Flash::success("[ {$article->title} ]   has beens deleted.");

    return redirect()->route('articles.index');
  }

}

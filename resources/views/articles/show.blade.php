@extends('layout')

@section('title')
  Article:{{ $article->title }}
@endsection

@section('content')
  <h1>{{ $article->title }}</h1>

  <hr/>

  <article>
    <div class="body">{{ $article->body }}</body>
  </article>

  @unless($article->tags->isEmpty())
    <h5>Tags:</h5>
    <ul>
      @foreach($article->tags as $tag)
        <li>{{ $tag->name }}</li>
      @endforeach
    </ul>
  @endunless

  @if(Auth::check())
    <br/>
    
    {!! link_to(action('ArticlesController@edit', [$article->id]), 'Edit', ['class' => 'btn btn-primary']) !!}

    <br/>
    <br/>

    {!! delete_form(['articles', $article->id])  !!}
  @endif
@endsection

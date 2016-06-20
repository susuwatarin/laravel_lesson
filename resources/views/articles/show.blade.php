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

  <br/>

  @if(Auth::check())
    {!! link_to(action('ArticlesController@edit', [$article->id]), 'Edit', ['class' => 'btn btn-primary']) !!}

    <br/>
    <br/>

    {!! delete_form(['articles', $article->id])  !!}
  @endif
@endsection

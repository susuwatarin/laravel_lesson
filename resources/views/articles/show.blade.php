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
@endsection

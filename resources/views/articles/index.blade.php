@extends('layout')

@section('title')
  Articles
@endsection

@section('content')
    <h1>Articles</h1>
 
    <hr/>
    
    @if(Auth::check())
        {!! link_to('articles/create', 'Create Aritcle', ['class' => 'btn btn-primary']) !!}
    @endif

    @foreach($articles as $article)
        <article>
            <h2>
                <a href="{{ url('articles', $article->id) }}">
                    {{ $article->title }}
                </a>
            </h2>
            <div class="body">
                {{ $article->published_at }}
            </div>
        </article>
    @endforeach

@endsection
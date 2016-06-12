@extends('layout')

@section('title')
  Articles
@endsection

@section('content')
    <h1>Articles</h1>
 
    <hr/>
    
    {!! link_to('articles/create', 'Create Aritcle', ['class' => 'btn btn-primary']) !!}

    @foreach($articles as $article)
        <article>
            <h2>
                <a href="{{ url('articles', $article->id) }}">
                    {{ $article->title }}
                </a>
            </h2>
            <div class="body">
                {{ $article->created_at }}
            </div>
        </article>
    @endforeach

@endsection
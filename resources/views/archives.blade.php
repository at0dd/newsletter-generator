@extends('layouts.master')
@section('title', 'Archives')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-xs-12 col-md-8 col-md-offset-2">
      <h2>Archives</h2>
      <ul class="news-nav">
        @foreach($categories as $category)
        <li><span class="notification">{{ count($category->articles()->where('approved', 1)->where('archived', 1)->get()) }}</span> <a href="#{{ $category->slug }}">{{ $category->category }}</a></li>
        @endforeach
      </ul>

      @foreach($categories as $category)
      @if(count($category->articles()->where('approved', 1)->where('archived', 1)->get()) > 0)
      <section id="{{ $category->slug }}">
        <h2>{{ $category->category }}</h2>
        <hr />
        @foreach($articles as $article)
        @if($article->categories()->first()->category == $category->category)
        <article>
          @if($article->link != null)
          <h4><a href="{{ $article->link }}" target="_blank">{{ $article->title }}</a></h4>
          @else
          <h4>{{ $article->title }}</h4>
          @endif
          <span class="date">{{ $article->date }}</span>
          <span class="location">{{ $article->location }}</span>
          <p>{{ $article->text }}</p>
        </article>
        @endif
        @endforeach
      </section>
      @endif
      @endforeach
      {{ $articles->links() }}
    </div>
  </div>
</div>
@endsection

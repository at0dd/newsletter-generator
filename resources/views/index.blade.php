@extends('layouts.master')
@section('title', 'This Week')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-xs-12 col-md-6 col-md-offset-3">
      @include('layouts/message')
    </div>
  </div>
</div>
<div class="container-fluid">
  <div class="row">
    <header class="col-xs-12 col-md-4">
      <h1>CS Weekly</h1>
      <p>Computer Science Weekly is an enewsletter distributed every week to CS faculty, staff and students.</p>
      <h3>Upcoming Events</h3>
      <ul class="upcoming">
        @foreach($articles as $article)
          @if($article->categories()->first()->category != "Job Opportunities" && $article->date != null)
            <span class="udate">{{ $article->date }}</span>
            @if($article->link != null)
            <li><span class="udatetime"><a href="{{ $article->link }}" target="_blank">{{ $article->title }}</a></span> @ {{ $article->location }}</li>
            @else
            <li><span class="udatetime">{{ $article->title }}</span> @ {{ $article->location }}</li>
            @endif
          @endif
        @endforeach
      </ul>
    </header>
    <div class="col-xs-12 col-md-8 news">
      <ul class="news-nav">
        @foreach($categories as $category)
        <li><span class="notification">{{ count($category->articles()->where('approved', 1)->get()) }}</span> <a href="#{{ $category->slug }}">{{ $category->category }}</a></li>
        @endforeach
      </ul>

      @foreach($categories as $category)
        @if(count($category->articles()->where('approved', 1)->get()) > 0)
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
    </div>
  </div>
</div>
@endsection

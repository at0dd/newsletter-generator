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
      <p>Computer Science Weekly is an enewsletter distributed to CS faculty, staff and students.</p>
      <h3>Upcoming Events</h3>
      <ul class="upcoming">
        @foreach($byDay as $day)
          @if(!empty($day))
          <li>
            <span class="dayofweek">{{ date("l, F j", strtotime($day[0]->date)) }}</span>
            <ul>
            @foreach($day as $article)
            <li>
              <span class="uptitle">
              @if($article->link != null)
                <a href="{{ $article->link }}" target="_blank">{{ $article->title }}</a>
              @else
                {{ $article->title }}
              @endif
            </span>
              <br /><span class="etime">{{ date("g:i A", strtotime($article->date)) }}</span> @
              @if($article->location != null)
                <span class="eloc">{{ $article->location }}</span>
              @endif
            </li>
            @endforeach
            </ul>
          </li>
          @endif
        @endforeach
      </ul>
    </header>
    <div class="col-xs-12 col-md-8 news">
      <ul class="news-nav">
        @foreach($categories as $category)
        <li><span class="notification">{{ $catCount[($category->id)-1] }}</span> <a href="#{{ $category->slug }}">{{ $category->category }}</a></li>
        @endforeach
      </ul>

      @foreach($categories as $category)
        @if($catCount[($category->id)-1] > 0)
        <section id="{{ $category->slug }}">
          <h2>{{ $category->category }}</h2>
          <hr />
          @foreach($articles as $article)
            @if($article->categories()->first()->category == $category->category)
              <article>
                <h4>
                  @if($article->link != null)
                    <a href="{{$article->link}}" target="_blank">{{ $article->title }}</a>
                  @else
                    {{ $article->title }}
                  @endif
                </h4>
                <span class="date">{{ $article->date != null ? date("l, F j, Y @ g:i A", strtotime($article->date)) : '' }}</span>
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

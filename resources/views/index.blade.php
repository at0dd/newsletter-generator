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
              <br /><span class="etime">{{ date("g:i A", strtotime($article->date)) }}</span>
              @if($article->location != null)
                <span class="eloc"> @ {{ $article->location }}</span>
              @endif
            </li>
            @endforeach
            </ul>
          </li>
          @endif
        @endforeach
      </ul>
      <hr />
      <h4>Important Links</h4>
      <ul>
        <li><a href="http://www.engg.ksu.edu/calendar/" target="_blank">College of Engineering-Student Events Calendar</a></li>
        <li><a href="http://www.engg.ksu.edu/sas/" target="_blank">SAS Tutoring</a></li>
        <li><a href="https://www.engg.ksu.edu/studentservices/" target="_blank">Student Services</a></li>
        <li><a href="http://www.engg.ksu.edu/asc/" target="_blank">Academic Success Center</a></li>
        <li><a href="https://twitter.com/kstate_CIS" target="_blank">Follow us on Twitter</a></li>
        <li><a href="https://www.facebook.com/CIS.KSU/" target="_blank">Like us on Facebook</a></li>
      </ul>
      <p>If you have an event or news you'd like to share in the next CS newsletter, submit the details at <a href="{{ url('/contribute') }}">{{ url('/contribute') }}</a> by Friday at noon.</p>
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

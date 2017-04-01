<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no" />
  <meta name="description" content="K-State Computer Science Newsletter.">
  <meta name="author" content="Alex Todd">
  <title>Computer Science Weekly | @yield('title')</title>
  <link rel="shortcut icon" href="{{ URL::asset('favicon.ico') }}">
  <link rel="apple-touch-icon-precomposed" href="{{ URL::asset('favicon.ico') }}" />
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,400italic" rel="stylesheet">
  <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
  <link href="{{ URL::asset('css/styles.css') }}" rel="stylesheet">
  @yield('head')
</head>

<body>
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-nav" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="{{ url('/') }}">Computer Science Weekly</a>
        </div>
        <div class="collapse navbar-collapse" id="main-nav">
          <ul class="nav navbar-nav">
            <li class="{{ Request::is('archives') ? 'active' : '' }}"><a href="{{ url('/archives') }}">Archives</a></li>
            <li class="{{ Request::is('contribute') ? 'active' : '' }}"><a href="{{ url('/contribute') }}">Contribute</a></li>
            <li class="{{ Request::is('guidelines') ? 'active' : '' }}"><a href="{{ url('/guidelines') }}">Guidelines</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            @if(Auth::check())
              @if(Auth::user()->hasRole('Administrator'))
                <li class="{{ Request::is('administration') ? 'active' : '' }}"><a href="{{ url('/administration') }}">Administration</a></li>
              @endif
              <li class="{{ Request::is('profile') ? 'active' : '' }}"><a href="{{ url('/profile') }}">Profile</a></li>
              <li><a href="{{ url('/auth/logout') }}">Logout</a></li>
            @else
              <li><a href="{{ url('/auth/login') }}">Login</a></li>
            @endif
          </ul>
        </div>
      </div>
    </nav>
    
    @yield('content')

  <script src="{{ URL::asset('js/jquery.min.js') }}"></script>
  <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
  @yield('footer')
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no" />
  <title>Computer Science Weekly</title>
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,400italic" rel="stylesheet">
  <style>
    body {
      text-align: center;
      font-family: 'Roboto',sans-serif;
    }
    a {
      transition: color 0.2s ease, border-bottom-color 0.2s ease;
      border-bottom: dotted 1px rgba(160, 160, 160, 0.65);
      text-decoration: none;
    }
    a:hover {
      color: #793CCC;
      text-decoration: underline;
    }
    a:visited {
      color: #512888;
    }
    .container {
      display: block;
      margin: 0px auto;
      padding: 10px;
    }
    section {
      margin: 25px auto;
      text-align: left;
    }
    section h2 {
      margin-bottom: 0;
      color: #793CCC;
    }
    article {
      margin-bottom: 30px;
    }
    article h4 {
      margin-bottom: 0;
    }
    article p {
      margin-top: 5px;
    }
    footer {
      margin-top: 75px;
    }
    .cp {
      font-weight: bold;
    }
  </style>
</head>

<body>
  <div class="container">
  <h1><a href="{{ url('/') }}">Computer Science Weekly</a></h1>
  <p>Kansas State University Department of Computer Science<br />{{ date("l, F j, Y", time()) }}</p>
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
    <section>
      <h2>Important Links</h2>
      <hr />
      <ul>
        <li><a href="http://www.engg.ksu.edu/calendar/">College of Engineering-Student Events Calendar</a></li>
        <li><a href="http://www.engg.ksu.edu/sas/">SAS Tutoring</a></li>
        <li><a href="https://www.engg.ksu.edu/studentservices/">Student Services</a></li>
        <li><a href="http://www.engg.ksu.edu/asc/">Academic Success Center</a></li>
        <li><a href="https://twitter.com/kstate_CIS">Follow us on Twitter</a></li>
        <li><a href="https://www.facebook.com/CIS.KSU/">Like us on Facebook</a></li>
      </ul>
    </section>
    <footer>
      <span class="cp">Computer Science Weekly</span><br />
      <p>If you have an event or news you'd like to share in the next CS newsletter, submit the details at <a href="{{ url('/contribute') }}">{{ url('/contribute') }}</a> by Friday at noon.</p>
      <a href="{{ url('/') }}">View this email in your browser.</a>
    </footer>
  </div>
</body>
</html>

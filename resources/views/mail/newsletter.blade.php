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
    }
    section {
      width: 60%;
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
  <h1>Computer Science Weekly</h1>
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
    <footer>
      <span class="cp">Computer Science Weekly</span><br />
      <a href="https://testing.atodd.io/newsletter-generator/public/">View this email in your browser.</a>
    </footer>
  </div>
</body>
</html>

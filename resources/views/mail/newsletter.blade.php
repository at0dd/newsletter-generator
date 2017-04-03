<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no" />
  <title>Computer Science Weekly</title>
</head>

<body>
  <h1>Computer Science Weekly</h1>
  <p>Hello world!</p>
  <ul>
  @foreach($articles as $article)
    <li>{{ $article->title }}</li>
  @endforeach
  </ul>
</body>
</html>

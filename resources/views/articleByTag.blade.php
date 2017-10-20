<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Article List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" />
    <script src="http://demo.itsolutionstuff.com/plugin/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>
</head>
<body>
<div class="container">
    <div class="col-md-8 col-md-offset-2">
        <h1>Article Lists</h1>
        @if($articles->count())
            @foreach($articles as $article)
                <h3>{{ $article->title }}</h3>
                <p>{{ $article->body }}</p>
                <div>
                    <strong>Tag:</strong>
                    @foreach($article->tags as $tag)
                        <label class="label label-info">{{ $tag->name }} <a href="{{ route('article.untag', ['article_id' => $article->id, 'tag' => $tag->name]) }}">x</a></label>
                    @endforeach
                </div>
            @endforeach
        @endif
    </div>
</div>
</body>
</html>
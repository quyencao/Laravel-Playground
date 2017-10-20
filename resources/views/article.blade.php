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
            <div class="panel panel-default">
                <div class="panel-heading"><h1>Add Article</h1></div>
                 <div class="panel-body">

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form class="form-horizontal"  action="{{ route('article') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">Title</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" required>

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                            <label for="body" class="col-md-4 control-label">Body</label>

                            <div class="col-md-6">
                                <textarea id="body" class="form-control" name="body" rows="5"></textarea>

                                @if ($errors->has('body'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('tags') ? ' has-error' : '' }}">
                            <label for="tags" class="col-md-4 control-label">Tags</label>

                            <div class="col-md-6">
                                <input type="text" id="tags" class="form-control" name="tags" data-role="tagsinput">

                                @if ($errors->has('tags'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tags') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Add Article
                                </button>
                            </div>
                        </div>
                    </form>
                 </div>
            </div>

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
            <hr>
            <h1>All Tags</h1>
            @foreach($tags as $tag)
                <label class="label label-info">
                    <a href="{{ route('tag.article', ['tag' => $tag->name]) }}">
                        {{ $tag->name }}
                    </a>
                </label>
            @endforeach
        </div>
    </div>
</body>
</html>
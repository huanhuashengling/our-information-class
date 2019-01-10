<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ trans('site.title') }}</title>    
    <link rel="icon" href="/img/oic.ico" type="image/x-icon" />
    <link href="//cdn.bootcss.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="//cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
    <script src="//cdn.bootcss.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</head>

    <div id="title" style="text-align: center;">
        <h1>{{ trans('site.title') }}</h1>
        <div style="padding: 5px; font-size: 16px;">{{ trans('site.title') }}</div>
    </div>
    <hr>
    <div id="content">
        <ul>
            @foreach ($posts as $post)
            <li style="margin: 50px 0;">
                <div class="title">
                    <a href="{{ url('post/'.$post->id) }}">
                        <h4>{{ $post->title }}</h4>
                    </a>
                </div>
                <div class="body">
                    <p>{{ $post->body }}</p>
                </div>
            </li>
            @endforeach
        </ul>
    </div>

</body>
</html>
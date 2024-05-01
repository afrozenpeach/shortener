<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    </head>
    <body>
        Long URL: <a href="{{ $url->longUrl }}">{{ $url->longUrl }}</a><br/>
        Short URL: <a href="/s/{{ $url->shortUrl }}">{{ $url->shortUrl }}</a><br/>
        Description: {{ $url->description }}<br/>
        Views: {{ $url->views }}<br/>
        Clicks: {{ $url->clicks }}
    </body>
</html>

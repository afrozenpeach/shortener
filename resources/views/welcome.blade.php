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
        Turns a long url (ex: https://some.url/goes/here) into a short url (ex: https://127.0.0.1/s/short) <br/><br/>

        @if(isset($error))
            <span style="color: RED;">{{ $error }}</span> <br/><br/>
        @endif
        <form action="/shorten" method="post" enctype="multipart/form-data">
            @csrf
            Long URL: <input type="text" name="longUrl" placeholder="https://some.url/goes/here" value="{{$long ?? ''}}">
            Short URL: <input type="text" name="shortUrl" placeholder="short" value="{{$short ?? ''}}">
            Description: <input type="text" name="description" value="{{$description ?? ''}}">
            <button type="submit">Shorten</button>
        </form>

        <br/><br/>

        CSV Upload:

        <form action="/upload" method="post" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file">
            <button type="submit">Upload</button>
        </form>
    </body>
</html>

<?php
use App\Models\url;
?>

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
        <?php
            foreach($results as $result) {
                $url = url::where('shortUrl', $result['shortUrl'])->first();

                ?>
                Long URL: <a href="{{ $url->longUrl }}">{{ $result['longUrl'] }}</a><br/>
                Short URL: <a href="/s/{{ $url->shortUrl }}">http://127.0.0.1:8000/s/{{ $result['shortUrl']}}</a><br/>
                Description: {{ $result['description'] }}<br/>

                @if($result['error'])
                    <span style="color: RED;">Error: {{ $result['error'] }}</span><br/>
                @endif
                <br/><br/>
                <?php
            }
        ?>
    </body>
</html>

<?php

use Illuminate\Support\Facades\Route;
use App\Models\url;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/shorten', function () {
    $longUrl = request('longUrl');

    if (request('shortUrl')) {
        $shortUrl = request('shortUrl');
    } else {
        $shortUrl = bin2hex(random_bytes(5));
    }

    $description = request('description');

    try {
        DB::table('urls')->insert([
            'longUrl' => $longUrl,
            'shortUrl' => $shortUrl,
            'description' => $description,
            'clicks' => 0,
            'views' => 0
        ]);
    } catch (Exception $e) {
        return view('welcome')->with('error', 'Short URL Already Exists. Try again.')
                              ->with('long', $longUrl)
                              ->with('short', $shortUrl)
                              ->with('description', $description);
    }
    return redirect('/shortened/' . DB::table('urls')->latest('id')->first()->id);
});

Route::get('/shortened/{id}', function ($id) {
    $url = url::find($id);

    $url->views++;

    $url->save();

    return view('shortened', [
        'url' => $url
    ]);
});

Route::get('/s/{shortUrl}', function ($shortUrl) {
    $url = url::where('shortUrl', $shortUrl)->first();

    $url->clicks++;

    $url->save();

    return redirect($url->longUrl);
});

Route::get('/s/{shortUrl}/info', function ($shortUrl) {
    $url = url::where('shortUrl', $shortUrl)->first();

    $url->views++;

    $url->save();

    return view('shortened', [
        'url' => $url
    ]);
});

Route::post('/upload', function () {
    $file = request('file');

    $contents = file_get_contents($file->getRealPath());

    $urls = explode("\n", $contents);

    $results = [];

    foreach ($urls as $url) {
        $url = explode(',', $url);
        $url = str_replace('"', "", $url);

        if ($url[1] == '') {
            $url[1] = bin2hex(random_bytes(5));
        }

        try {
            DB::table('urls')->insert([
                'longUrl' => $url[0],
                'shortUrl' => $url[1],
                'description' => $url[2],
                'clicks' => 0,
                'views' => 0
            ]);

            $results[] = [
                'longUrl' => $url[0],
                'shortUrl' => $url[1],
                'description' => $url[2],
                'error' => null
            ];
        } catch (Exception $e) {
            $results[] = [
                'longUrl' => $url[0],
                'shortUrl' => $url[1],
                'description' => $url[2],
                'error' => 'Short URL Already Exists. Try again.'
            ];
        }
    }

    return view('uploaded', [
        'results' => $results
    ]);
});
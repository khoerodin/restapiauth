<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/redirect', function () {
    $query = http_build_query([
        'client_id' => 3,
        // 'client_secret' => 'PKjagMn8UMaulcy4bQRToTTtTrrfkdUzQIkc34EC',
        'redirect_uri' => 'http://example.com/callback',
        'response_type' => 'code',
        'scope' => '',
    ]);

    return redirect('http://127.0.0.1:8000/oauth/authorize?'.$query);
});

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/google-auth-url', function () {
    $response = Http::get('http://localhost:3002/oauth/auth');
    return $response->json();
})->name('login');


Route::get('/save-token', function (Request $request) {
    session([
        'access_token' => $request->query('access_token'),
        'refresh_token' => $request->query('refresh_token'),
        'user_email' => $request->query('email')
    ]);

    return redirect('/home');
});

Route::get('/home', function () {
    return view('home');
})->name('home');


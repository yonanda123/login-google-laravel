<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/google-auth-url', function () {
    $response = Http::get('https://stg-ch-ai.beoverflow.com/oauth/auth');
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

Route::post('/create-project', function () {
    $accessToken = session('access_token');
    $userEmail = session('user_email');
    $projectName = 'project12345';

    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . $accessToken,
        'Content-Type' => 'application/json'
    ])->post('https://stg-ch-ai.beoverflow.com/oauth/create-project', [
        'email' => $userEmail,
        'projectName' => $projectName
    ]);

    if ($response->successful()) {
        return response()->json($response->json());
    } else {
        return response()->json([
            'error' => $response->status(),
            'message' => $response->body()
        ], $response->status());
    }
})->name('create-project');

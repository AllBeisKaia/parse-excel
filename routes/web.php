<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParserController;
use App\Http\Controllers\SiteController;

Route::controller(SiteController::class)->group(function() {
    Route::get('/', 'index')->name('home');

    Route::middleware('guest')->group(function() {
        Route::get('/login', 'loginForm')->name('loginForm');
        Route::post('/login', 'login')->name('login');

        Route::get('/register', 'registerForm')->name('registerForm');
        Route::post('/register', 'register')->name('register');
    });

    Route::middleware('auth')->group(function() {
        Route::get('/logout', 'logout')->name('logout');
    });
});

Route::group(
    ['middleware' => 'auth', 'controller' => ParserController::class, 'prefix' => 'parser'],
    function() {
        Route::get('/', 'index')->name('parser.index');

        Route::get('parserForm', 'parserForm')->name('parser.parserForm');
        Route::post('parseExcel', 'parseExcel')->name('parser.parseExcel');
    }
);

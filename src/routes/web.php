<?php

use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
})->middleware(SetLocale::class)->name('home');

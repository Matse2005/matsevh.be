<?php

use Illuminate\Support\Facades\Route;
use Spatie\Sitemap\SitemapGenerator;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/projecten', function () {
    return view('projects');
})->name('projects');

Route::get('/mijn-cv', function () {
    return view('cv');
})->name('cv');

Route::get('/contacteer-mij', function () {
    return view('contact');
})->name('contact');

Route::get('/gen', function () {
    SitemapGenerator::create('https://matsevh.be')->writeToFile($path);
})->name('contact');

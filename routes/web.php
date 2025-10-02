<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

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

Route::get('/phpinfo', function () {
    phpinfo();
});

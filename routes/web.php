<?php

use App\Models\Project;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/projecten', function () {
    return view('projects');
})->name('projects');

Route::get('/project/{project}/{slug}', function (Project $project) {
    return view('project', ['project' => $project]);
})->name('project');

Route::get('/mijn-cv', function () {
    return view('cv');
})->name('cv');

Route::get('/contacteer-mij', function () {
    return view('contact');
})->name('contact');

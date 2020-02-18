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
    return view('create-hero');
});

Route::get('/myheroes/createhero', function () {
    return view('create-hero');
})->name('create-hero');

Route::get('/myheroes/createteam', function () {
    return view('create-team');
})->name('create-team');

Route::get('/teams', function () {
    return view('view-teams');
})->name('view-teams');

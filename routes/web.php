<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});
Route::get('/index', function () {
    return view('index');
})->name('index');
Route::get('/employeelist', function () {
    return view('employeelist');
})->name('employeelist');
Route::get('/logout', function () {
    return view('logout');
})->name('logout');

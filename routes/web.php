<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\employeeController;
use Illuminate\support\Facades\DB;
Route::get('/', function () {
    return view('index');
});
Route::get('/index', function () {
    return view('index');
})->name('index');

Route::resource('employee',employeeController::class);

Route::get('/logout', function () {
    return view('logout');
})->name('logout');

<?php

use Illuminate\Support\Facades\Route;

use Illuminate\support\Facades\DB;
use App\Http\Controllers\employeeController;
Route::get('/admin', function () {
    return view('/admin/index');
})->name('index');
Route::get('/admin/employee',[employeeController::class,'index'])->name('employee.index');

Route::get('/admin/employee', [employeeController::class,'getdata'])->name('admin.emplist');
Route::get('/admin/logout', function () {
    return view('admin/logout');
})->name('logout');

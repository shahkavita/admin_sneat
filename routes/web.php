<?php

use Illuminate\Support\Facades\Route;

use Illuminate\support\Facades\DB;
use App\Http\Controllers\employeeController;
Route::get('/admin', function () {
    return view('/admin/index');
})->name('index');
Route::get('admin/employee',[employeeController::class,'index'])->name('employee.index');
Route::post('admin/employee', [employeeController::class, 'savedata'])->name('save');
Route::get('admin/employee/index', [employeeController::class,'getdata'])->name('admin.emplist');
Route::get('admin/employee/{id}', [employeeController::class,'viewdata'])->name('admin.singleemp');
Route::delete('admin/employee/{id}', [employeeController::class,'deletedata'])->name('delete');

Route::get('admin/employee/{id}', [employeeController::class,'data'])->name('edit');
Route::PUT('admin/employee/{id}', [employeeController::class,'updatedata'])->name('update');


Route::get('/admin/logout', function () {
    return view('admin/logout');
})->name('logout');

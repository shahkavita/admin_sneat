<?php

use Illuminate\Support\Facades\Route;

use Illuminate\support\Facades\DB;
use App\Http\Controllers\employeeController;
use App\Http\Controllers\productController;
Route::get('/', function () {
    return view('/admin/index');
})->name('index');
Route::get('admin/employee',[employeeController::class,'index'])->name('employee.index');
Route::post('admin/employee', [employeeController::class, 'savedata'])->name('save');
Route::get('admin/employee/index', [employeeController::class,'getdata'])->name('admin.emplist');
Route::get('admin/employee/{id}', [employeeController::class,'viewdata'])->name('admin.singleemp');
Route::delete('admin/employee/{id}', [employeeController::class,'deletedata'])->name('delete');
Route::get('admin/employee/{id}', [employeeController::class,'data'])->name('edit');

Route::get('admin/product',[productController::class,'index'])->name('product.index');
Route::get('admin/product/index', [productController::class,'getdata'])->name('admin.categorylist');
Route::delete('admin/product/{id}', [productController::class,'deletedata'])->name('admin.delete');
Route::post('admin/product', [productController::class, 'savedata'])->name('save');

Route::get('admin/product/{id}', [productController::class,'editdata'])->name('admin.edit');

Route::get('/admin/logout', function () {
    return view('admin/logout');
})->name('logout');

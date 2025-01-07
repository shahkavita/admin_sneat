<?php

use Illuminate\Support\Facades\Route;

use Illuminate\support\Facades\DB;
use App\Http\Controllers\employeeController;
use App\Http\Controllers\productcategoryController;

use App\Http\Controllers\demoController;

Route::get('/', function () {
    return view('/admin/index');
})->name('index');
Route::get('admin/employee',[employeeController::class,'index'])->name('employee.index');
Route::post('admin/employee', [employeeController::class, 'savedata'])->name('save');
Route::get('admin/employee/index', [employeeController::class,'getdata'])->name('admin.emplist');
Route::get('admin/employee/{id}', [employeeController::class,'viewdata'])->name('admin.singleemp');
Route::delete('admin/employee/{id}', [employeeController::class,'deletedata'])->name('delete');
Route::get('admin/employee/{id}', [employeeController::class,'data'])->name('edit');

Route::get('admin/product/demo',[demoController::class,'get'])->name('demo.get');
Route::get('admin/product/demo/index', [demoController::class, 'index'])->name('demo.index');

Route::get('admin/product', [productcategoryController::class,'index'])->name('product.index');
Route::get('admin/product/category',[productcategoryController::class,'index'])->name('product.category');
Route::get('admin/product/category/index', [productcategoryController::class,'getdata'])->name('admin.categorylist');
Route::delete('admin/product/category/{id}', [productcategoryController::class,'deletedata'])->name('admin.delete');
Route::post('admin/product/category', [productcategoryController::class, 'savedata'])->name('save');

Route::get('admin/product/category/{id}', [productcategoryController::class,'editdata'])->name('admin.edit');

Route::get('/admin/logout', function () {
    return view('admin/logout');
})->name('logout');

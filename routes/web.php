<?php

use Illuminate\Support\Facades\Route;
use Illuminate\support\Facades\DB;

use App\Http\Controllers\authcontroller;
use App\Http\Controllers\employeeController;
use App\Http\Controllers\productcategoryController;

use App\Http\Controllers\demoController;

Route::get('/', function () {
    return view('admin.auth.login');
})->name('index');


// This will now accept POST requests for the registration route
Route::get('/register', [authcontroller::class, 'register'])->name('register');
Route::any('/login', [authcontroller::class, 'login'])->name('login');
// Other routes
Route::any('/admin', [authcontroller::class, 'index'])->name('dashboard');
Route::get('/logout', [authcontroller::class, 'logout'])->name('admin.logout');


Route::post('/login/check', [authcontroller::class, 'loginuser'])->name('login.user');
Route::post('/forgot', [authcontroller::class, 'forgot'])->name('forgot');
Route::post('/register/save', [authcontroller::class, 'registeruser'])->name('register.user');

Route::get('admin/employee',[employeeController::class,'index'])->name('employee.index');
Route::post('admin/employee', [employeeController::class, 'savedata'])->name('employee.save');
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
Route::post('admin/product/category', [productcategoryController::class, 'savedata'])->name('category.save');

Route::get('admin/product/category/{id}', [productcategoryController::class,'editdata'])->name('admin.edit');



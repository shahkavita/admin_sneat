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
Route::get('/login', [authcontroller::class, 'login'])->name('login');
// Other routes
Route::get('/logout', [authcontroller::class, 'logout'])->name('admin.logout');

Route::post('/login', [authcontroller::class, 'loginuser'])->name('login.user');
Route::get('/forgot', [authcontroller::class, 'forgotpassword'])->name('forgot');
Route::post('/register', [authcontroller::class, 'registeruser'])->name('register.user');
Route::post('/resetpassword', [authcontroller::class, 'resetpass'])->name('password.reset');
Route::post('/resetpassword/{token}', [authcontroller::class, 'reset'])->name('password.resetform');
Route::post('/updatepassword',[authcontroller::class,'updatepassword'])->name('password.update');

Route::middleware(['auth'])->prefix('admin')->group(function () {
        Route::get('/', [authcontroller::class, 'index'])->name('dashboard');
        Route::get('/employee',[employeeController::class,'index'])->name('employee.index');
        Route::post('/employee', [employeeController::class, 'savedata'])->name('employee.save');
        Route::get('/employee/index', [employeeController::class,'getdata'])->name('admin.emplist');
        Route::get('/employee/{id}', [employeeController::class,'viewdata'])->name('admin.singleemp');
        Route::delete('/employee/{id}', [employeeController::class,'deletedata'])->name('delete');
        Route::get('/employee/{id}', [employeeController::class,'data'])->name('edit');

        Route::get('/product', [productcategoryController::class,'index'])->name('product.index');
        Route::get('/product/category',[productcategoryController::class,'index'])->name('product.category');
        Route::get('/product/category/index', [productcategoryController::class,'getdata'])->name('admin.categorylist');
        Route::delete('/product/category/{id}', [productcategoryController::class,'deletedata'])->name('admin.delete');
        Route::post('/product/category', [productcategoryController::class, 'savedata'])->name('category.save');
        Route::get('/product/category/{id}', [productcategoryController::class,'editdata'])->name('admin.edit');       
});

Route::get('admin/product/demo',[demoController::class,'get'])->name('demo.get');
Route::get('admin/product/demo/index', [demoController::class, 'index'])->name('demo.index');




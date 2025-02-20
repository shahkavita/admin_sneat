<?php

use Illuminate\Support\Facades\Route;
use Illuminate\support\Facades\DB;

use App\Http\Controllers\productController;
use App\Http\Controllers\emailEmployeeController;
use App\Http\Controllers\authcontroller;
use App\Http\Controllers\employeeController;
use App\Http\Controllers\productcategoryController;
use App\Http\Controllers\teamController;
use App\Http\Controllers\smtpController;

use App\Http\Controllers\demoController;

use App\Http\Controllers\settingController;
use App\Http\Controllers\generalSettingsController;

Route::get('/', function () {
    return view('admin.auth.login');
})->name('index');

// This will now accept POST requests for the registration route
Route::get('/register', [authcontroller::class, 'register'])->name('register');
Route::get('/login', [authcontroller::class, 'login'])->name('login');
// Other routes
Route::get('/logout', [authcontroller::class, 'logout'])->name('admin.logout');

Route::post('/login', [authcontroller::class, 'loginuser'])->name('login.user');
Route::post('/register', [authcontroller::class, 'registeruser'])->name('register.user');
Route::get('/forgot', [authcontroller::class, 'forgotpassword'])->name('forgot');
Route::post('/forgotpassword', [authcontroller::class, 'resetpass'])->name('forgot.password');

Route::get('/reset-password/{token}', [authcontroller::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('/updatepassword', [authcontroller::class, 'submitResetPasswordForm'])->name('reset.password.post');


Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/', [authcontroller::class, 'index'])->name('dashboard');
    Route::get('/employee', [employeeController::class, 'index'])->name('employee.index');
    Route::post('/employee', [employeeController::class, 'savedata'])->name('employee.save');
    Route::post('/employee/list', [employeeController::class,'list'])->name('admin.employee.list');
    Route::get('/employee/index', [employeeController::class, 'getdata'])->name('admin.emplist');
    Route::get('/employee/{id}', [employeeController::class, 'viewdata'])->name('admin.singleemp');
    Route::delete('/employee/{id}', [employeeController::class, 'deletedata'])->name('delete');
    Route::get('/employee/{id}', [employeeController::class, 'data'])->name('edit');

    Route::get('/product', [productcategoryController::class, 'index'])->name('admin.product.index');
    Route::get('/product/category', [productcategoryController::class, 'index'])->name('admin.product.category');
    Route::post('/product/category/list', [productcategoryController::class, 'list'])->name('admin.product.list');
    Route::get('/product/category/index', [productcategoryController::class, 'getdata'])->name('admin.categorylist');
    Route::delete('/product/category/{id}', [productcategoryController::class, 'deletedata'])->name('admin.delete');
    Route::post('/product/category', [productcategoryController::class, 'savedata'])->name('category.save');
    Route::get('/product/category/{id}', [productcategoryController::class, 'editdata'])->name('admin.edit');

    Route::get('/productdetails', [productController::class, 'index'])->name('product');
    Route::POST('/product/list', [productController::class, 'list'])->name('product.list');
    Route::POST('/product/addproduct', [productController::class, 'savedata'])->name('product.add');
    Route::delete('/products/{id}', [productController::class, 'deletedata'])->name('products.destroy');
    Route::get('/product/editproduct/{id}', [productController::class, 'getdata'])->name('products.getdata');
  
    Route::get('/team', [teamController::class, 'index'])->name('team.index');
    Route::POST('/team/list', [teamController::class, 'list'])->name('team.list');
    Route::POST('/team/add', [teamController::class, 'savedata'])->name('team.save');
    Route::delete('/team/{id}', [teamController::class, 'deletedata'])->name('team.destroy');
    Route::get('/team/edit/{id}', [teamController::class, 'getdata'])->name('team.getdata');
  
    Route::get('/email',[emailEmployeeController::class,'index'])->name('email.employee.index');
    Route::POST('/email/send',[emailEmployeeController::class,'senddata'])->name('email.send');

    Route::get('/settings/index',[settingController::class,'index'])->name('settings.index');
   
    Route::get('/settings/fetchsettings',[generalSettingsController::class,'fetchsettings'])->name('settings.fetch');
    Route::get('/settings/getstate/{country_id}',[generalSettingsController::class,'getstate'])->name('settings.state');
    Route::get('/settings/getcity/{state_id}',[generalSettingsController::class,'getcity'])->name('settings.city');
    Route::post('/settings/general/updatesettings',[generalSettingsController::class,'updatesettings'])->name('settings.update');

    Route::POST('/settings/smtp/updatesmtp',[smtpController::class,'updatesmtp'])->name('smtp.update');
    Route::get('/settings/smtpsettings',[smtpController::class,'fetchsmtp'])->name('smtp.fetch');
    Route::POST('/settings/smtp/test',[smtpController::class,'testsmtp'])->name('smtp.test');

});
Route::get('admin/product/demo', [demoController::class, 'get'])->name('demo.get');
Route::get('admin/product/demo/index', [demoController::class, 'index'])->name('demo.index');

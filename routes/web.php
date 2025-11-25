<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Api\ProductControllerApi;
use App\Http\Controllers\Api\CategoryControllerApi;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\LogoutController;


use App\Http\Controllers\OrderController;
use App\Models\Order;

use App\Http\Controllers\OrderDetailController;
use App\Models\OrderDetail;

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


// Health check route for Railway
Route::get('/health', function () {
    return response()->json(['status' => 'ok'], 200);
});

Route::get('/', function () {
    return redirect('/home');
});

Route::get('/test', function () {
    $test = Order::find(1); 
    $test2 = $test->detail;
    return compact('test');
});


Route::get('/product', [ProductController::class , 'index']);
Route::post('/product/search', [ProductController::class , 'search']);
Route::get('/product/search', [ProductController::class , 'search']);
Route::get('/product/edit/{id?}' , [ProductController::class , 'edit']);
Route::post('/product/update' , [ProductController::class , 'update']);


Route::get('/category', [CategoryController::class , 'index']);
Route::post('/category/search', [CategoryController::class , 'search']);
Route::get('/category/search', [CategoryController::class , 'search']);
Route::get('/category/edit/{id?}' , [CategoryController::class , 'edit']);
Route::post('/category/update' , [CategoryController::class , 'update']);


Route::get('/product/insert' , [ProductController::class,'insert']);
Route::post('/product/insert' , [ProductController::class,'insert']);

Route::get('/product/remove/{id}' , [ProductController::class,'remove']);

Route::get('/category/remove/{id}' , [CategoryController::class,'remove']);


Route::get('/category/insert' , [CategoryController::class,'insert']);
Route::post('/category/insert' , [CategoryController::class,'insert']);



// Route::get('/api/product', [ProductControllerApi::class, 'product_list']);
// Route::get('/api/category', [CategoryControllerApi::class, 'category_list']);

// Route::get('/api/product/{category_id?}' , [ProductControllerApi::class, 'product_list']);

Route::get('/cart/view', [CartController::class, 'viewCart']);
Route::get('/cart/add/{id}', [CartController::class, 'addToCart']);

Route::get('/cart/delete/{id}', [CartController::class, 'deleteCart']);


Route::get('/cart/update/{id}/{qty}', [CartController::class, 'updateCart']);
// Authentication Routes...
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('logout', [LogoutController::class, 'logout']);

// Registration Routes...
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Password Reset Routes...
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// Email Verification Routes...
Route::get('email/verify', [VerificationController::class, 'show'])->name('verification.notice');
Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
    ->middleware(['signed'])
    ->name('verification.verify');
Route::post('email/resend', [VerificationController::class, 'resend'])->name('verification.resend');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/cart/checkout', [CartController::class, 'checkout']);



// ของอันใหม่ Project //
Route::get('/cart/complete', [CartController::class, 'complete']);
Route::get('/cart/addtoorder', [CartController::class, 'addtoorder']);
Route::get('/order', [OrderController::class, 'index']);
Route::get('/cart/finish',[CartController::class, 'finish_order']);

//==========================================// User //==========================================//
Route::get('/user', [UserController::class, 'index']);
Route::get('/user/search', [UserController::class, 'search']);
Route::post('/user/search', [UserController::class, 'search']);
Route::get('/user/edit/{id?}', [UserController::class, 'edit']);
Route::post('/user/update', [UserController::class, 'update']);
Route::post('/user/add', [UserController::class, 'insert']);
Route::get('/user/remove/{id}', [UserController::class, 'remove']);

Route::get('/orderdetail/{id}', [OrderDetailController::class, 'index']);
Route::get('/orderdetail/edit1/{id}', [OrderDetailController::class, 'editstatus1']);
Route::get('/orderdetail/edit2/{id}', [OrderDetailController::class, 'editstatus2']);
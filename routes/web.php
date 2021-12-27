<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminLangController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CameraController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use GuzzleHttp\Middleware;
use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Support\Facades\Route;

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

Route::GET('/', [HomeController::class, 'index'])->name('home');
Route::GET('/home', [HomeController::class, 'index'])->name('home');

Route::group(['as' => 'home.', 'prefix' => 'home'], function () {
    Route::GET('/result_search', [HomeController::class, 'result_search'])->name('result_search');
    Route::GET('/translated', [HomeController::class, 'translated'])->name('translated');
    Route::GET('/input_translated', [HomeController::class, 'input_translated'])->name('input_translated');
    Route::GET('/output_lang', [HomeController::class, 'output_lang'])->name('output_lang');
    Route::GET('/input_lang', [HomeController::class, 'input_lang'])->name('input_lang');
    Route::GET('/lang_details', [HomeController::class, 'lang_details'])->name('lang_details');
    Route::GET('/check_exist_email', [AuthController::class, 'check_exist_email'])->name('check_exist_email');
    Route::GET('/insert_history', [HomeController::class, 'insert_history'])->name('insert_history');
    Route::GET('/suggestion_input', [HomeController::class, 'suggestion_input'])->name('suggestion_input');
    Route::GET('/suggestion_output', [HomeController::class, 'suggestion_output'])->name('suggestion_output');

    Route::GET('/histories', [HomeController::class, 'histories'])->name('histories');
//    camera
    Route::GET('/camera', [CameraController::class, 'camera'])->name('camera');
    Route::GET('/result_camera', [CameraController::class, 'result_camera'])->name('result_camera');

});


Route::get('/register','AuthController@register')->name('engkid.register');
Route::get('/forgot','AuthController@forgot')->name('engkid.forgot');


Route::get('/search','SearchController@search')->name('engkid.search');

Route::get('/search/{id}','SearchController@detail')->name('engkid.detail');


//admin
Route::group(['middleware' => ['check_login_admin'], 'as' => 'admin.', 'prefix' => 'admin'], function () {
    Route::get('/login', [AdminController::class, 'login'])->name('login');
    Route::POST('/confirm', [AdminController::class, 'confirm'])->name('confirm');
    Route::get('/dashboard', [AdminController::class, 'show_dashboard'])->name('dashboard');
    Route::get('/logout', [AdminController::class, 'logout'])->name('logout');

    //manage user
    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
        Route::get('/list', [AdminUserController::class, 'index'])->name('list');
        Route::GET('/add', [AdminUserController::class, 'create'])->name('add');
        Route::GET('/edit/{id}', [AdminUserController::class, 'show'])->name('edit');
        Route::GET('/store', [AdminUserController::class, 'store'])->name('store');
        Route::POST('/update', [AdminUserController::class, 'update'])->name('update');
        Route::DELETE('/delete/{id}', [AdminUserController::class, 'destroy'])->name('delete');

    });

    //manage language
    Route::group(['prefix' => 'lang', 'as' => 'lang.'], function () {
        Route::get('/list', [AdminLangController::class, 'index'])->name('list');
        Route::get('/add', [AdminLangController::class, 'create'])->name('add');
        Route::get('/edit/{id}', [AdminLangController::class, 'edit'])->name('edit');
        Route::POST('/store', [AdminLangController::class, 'store'])->name('store');
        Route::POST('/update/{id}', [AdminLangController::class, 'update'])->name('update');
        Route::DELETE('/delete/{id}', [AdminLangController::class, 'destroy'])->name('delete');

    });
});

//user
Route::group(['middleware' => ['check_login_user'], 'as' => 'user.', 'prefix' => 'user'], function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::GET('/confirm', [AuthController::class, 'confirm'])->name('confirm');
    Route::GET('/confirm-register', [AuthController::class, 'confirm_register'])->name('confirm-register');
    Route::GET('/history', [UserController::class, 'history'])->name('history');

});

Route::group(['middleware' => ['check_not_login'], 'as' => 'guest.','prefix' => 'guest'], function () {
    Route::get('/forgot-account', [UserController::class, 'forgot_account'])->name('forgot-account');
    Route::get('/otp-account', [UserController::class, 'otp_account'])->name('otp-account');
    Route::get('/change-password', [UserController::class, 'change_password'])->name('change-password');

});

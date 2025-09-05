<?php

use Illuminate\Support\Facades\Route;

//CONTROLLER
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\_DashboardController;
use App\Http\Controllers\_MessageController;
use App\Http\Controllers\_ServiceController;
use App\Http\Controllers\_ToolController;
use App\Http\Controllers\_LanguageController;
use App\Http\Controllers\_UserController;
use App\Http\Controllers\_SocialController;

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
// HOME
Route::get('/', [HomeController::class,'index'])->name('home');
Route::get('/about', [HomeController::class,'about'])->name('about');
Route::get('/services', [HomeController::class,'services'])->name('services');
Route::get('/services/{id}', [HomeController::class,'orderService'])->name('order-service');
Route::get('/contact', [HomeController::class,'contact'])->name('contact');
Route::post('/dashboard/message', [_MessageController::class,'store'])->name('create-message');

Route::middleware(['guest'])->group(function () { 
    Route::get('/login', [AuthController::class,'index'])->name('view-login');
    Route::post('/login', [AuthController::class,'login'])->name('login');
});

Route::middleware(['auth'])->group(function () { 
    // DASHBOARD
    Route::get('/dashboard', [_DashboardController::class,'index'])->name('dashboard');
    
    //PROFILE
    Route::get('/dashboard/profile', [_UserController::class,'index'])->name('profile'); 
    Route::put('/dashboard/profile/{id}', [_UserController::class,'update'])->name('update-profile'); 
    
    //SOCIAL MEDIA
    Route::post('/dashboard/social', [_SocialController::class,'store'])->name('create-social'); 
    Route::put('/dashboard/social/{id}', [_SocialController::class,'update'])->name('update-social'); 
    Route::get('/dashboard/social/{id}', [_SocialController::class,'getById'])->name('social-by-id');

    // MESSAGE
    Route::get('/dashboard/message', [_MessageController::class,'index'])->name('message');
    Route::get('/dashboard/message/{id}', [_MessageController::class,'getById'])->name('message-by-id');

    // SERVICE
    Route::get('/dashboard/service', [_ServiceController::class,'index'])->name('service');
    Route::get('/dashboard/service/{id}', [_ServiceController::class,'getById'])->name('service-by-id');
    Route::post('/dashboard/service', [_ServiceController::class,'store'])->name('create-service');
    Route::put('/dashboard/service/{id}', [_ServiceController::class,'update'])->name('update-service');

    // TOOL
    Route::get('/dashboard/tool', [_ToolController::class,'index'])->name('tool');
    Route::get('/dashboard/tool/{id}', [_ToolController::class,'getById'])->name('tool-by-id');
    Route::post('/dashboard/tool', [_ToolController::class,'store'])->name('create-tool');
    Route::put('/dashboard/tool/{id}', [_ToolController::class,'update'])->name('update-tool');

    // LANGUAGE
    Route::get('/dashboard/language', [_LanguageController::class,'index'])->name('language');
    Route::get('/dashboard/language/{id}', [_LanguageController::class,'getById'])->name('language-by-id');
    Route::post('/dashboard/language', [_LanguageController::class,'store'])->name('create-language');
    Route::put('/dashboard/language/{id}', [_LanguageController::class,'update'])->name('update-language');

    Route::post('/logout', [AuthController::class,'logout'])->name('logout');
});

// AUTH

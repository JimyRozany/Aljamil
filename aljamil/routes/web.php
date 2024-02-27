<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CategoryController;



use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\General\HomeController;
use App\Http\Controllers\ProductController;

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




// Admin Routes

Route::get("/login", [AuthController::class, "getLogin"])->middleware("guest");
Route::post("/login", [AuthController::class, "login"])->name("login");

// protected
Route::middleware("auth:admin")->group(function () {
    Route::get("/logout", [AuthController::class, "logout"])->middleware("prevent.back")->name("logout");

    Route::get("/", [HomeController::class, "home"])->name("home");
    // Route::get("/companies", [HomeController::class ,"companies"])->name("companies");



    // company resource routes
    Route::resource('company', CompanyController::class);
    // category resource routes
    Route::resource('category', CategoryController::class);
    // product resource routes
    Route::resource("product" ,ProductController::class);
});

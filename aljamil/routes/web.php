<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\General\HomeController;
use Illuminate\Support\Facades\Route;



use Illuminate\Http\Request;


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
Route::middleware("auth:admin")->group(function(){
    Route::get("/logout", [AuthController::class, "logout"])->middleware("prevent.back")->name("logout");
    
    Route::get("/", [HomeController::class ,"home"])->name("home");
    // Route::get("/companies", [HomeController::class ,"companies"])->name("companies");



    // company resource routes
    Route::resource('company', CompanyController::class);
    Route::post('company/update', [CompanyController::class ,"update"]);

    Route::get("bla" ,function () {
        return response()->json("success" ,200) ;
    });
    Route::post("post-route" ,function (Request $req) {
        // return response()->json("success" ,200) ;
        return  $req ;
    });
});

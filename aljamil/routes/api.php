<?php

use App\Http\Controllers\API\GeneralController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\General\HomeController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\CartController;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post("/register", [AuthController::class, "register"]);
Route::post("/login", [AuthController::class, "login"]);
Route::middleware("jwt.verify")->group(function () {
    Route::post("/logout", [AuthController::class, "logout"]);
    Route::post("/me", [AuthController::class, "me"]);



    // get all products
    Route::post("products", [GeneralController::class, 'products']);
    // get all categories
    Route::post("categories", [GeneralController::class, 'categories']);
    // get all companies
    Route::post("companies", [GeneralController::class, 'companies']);

    // resource cart 
    Route::apiResource('cart', CartController::class);
    // get my favorites
    Route::get("favorites", [FavoriteController::class, "index"]);
    // add to favorites
    Route::post("favorites", [FavoriteController::class, "store"]);
    // delete from favorites
    Route::delete("favorites/{id}", [FavoriteController::class, "destroy"]);
    // ----end favorites routes ------

});

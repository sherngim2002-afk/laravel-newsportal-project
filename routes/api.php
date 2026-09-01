<?php

use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::middleware('auth:sanctum')->group(function () {
    Route::get("/category/{slug}", [CategoryController::class, "category"]);

    Route::middleware('admin')->group(function () {
        Route::get("/categories", [CategoryController::class, "categories"]);
        Route::post("/category/store", [CategoryController::class, "store"]);
        Route::patch("/category/update/{id}", [CategoryController::class, "update"]);
        Route::delete("/category/delete/{id}", [CategoryController::class, "delete"]);
    });
});

Route::get("/latest-article", [ArticleController::class, "latest_article"]);
Route::get("/article/{slug}", [ArticleController::class, "article"]);


// Auth Routes
Route::post("/register", [AuthController::class, "register"]);
Route::post("/login", [AuthController::class, "login"]);

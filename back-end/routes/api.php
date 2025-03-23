<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\SnippetController;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

Route::group(["prefix" => "v0.1"], function(){
    Route::group(["middleware" => "auth:api"], function(){
        Route::get('/validate-token',[AuthController::class, "validate_token"]);

        //Snippets APIs
        Route::post('/delete_snippet', [SnippetController::class, "deleteSnippet"]);
        Route::post('/add_update_snippet', [SnippetController::class, "addOrUpdateSnippet"]);

        //Favorites APIs
        Route::post('/add_favorite', [FavoriteController::class, "addFavorite"]);
        Route::post('/get_favorites', [FavoriteController::class, "getFavorites"]);
        Route::post('/delete_favorite', [FavoriteController::class, "deleteFavorite"]);
    });
    // Route::get("/test",[UserController::class,'getUsers']);
    Route::post('/login', [AuthController::class, "login"]);
    Route::post('/signup', [AuthController::class, "signup"]);

});


<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SnippetController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(["prefix" => "v0.1"], function(){
    Route::group(["middleware" => "auth:api"], function(){
        // dd("da");
        // Route::get("/test",[UserController::class,'getUsers']);
    });
    Route::get("/test",[UserController::class,'getUsers']);
    Route::post('/login', [AuthController::class, "login"]);
    Route::post('/signup', [AuthController::class, "signup"]);

    //Snippets Code
    Route::post('/add_update_snippet', [SnippetController::class, "addOrUpdateSnippet"]);
    Route::post('/delete_snippet', [SnippetController::class, "deleteSnippet"]);

});


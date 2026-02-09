<?php


use App\Chore\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController; 

// Rota get
// Route::get('/', HomeController::class);


Route::resource('/post', PostController::class);

Route::get('/teste', HomeController::class);

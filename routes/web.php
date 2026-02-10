<?php

use App\Chore\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;

/**
 * Este arquivo define rotas na aplicação
 * Ex: 
 *  Route::get('nome_da_uri', nome_do_controller::class);
 */

Route::get('/', HomeController::class);

Route::resource('/post', PostController::class);
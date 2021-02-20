<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\JwtAuthController;
use App\Http\Controllers\Api\AtributosController;
use App\Http\Controllers\Api\AtributoValoresController;
use App\Http\Controllers\Api\EstoquesController;
use App\Http\Controllers\Api\ProdutosController;
use App\Http\Controllers\Api\ProdutoVariacoesController;

Route::post('register', [JwtAuthController::class, 'register']);
Route::post('login', [JwtAuthController::class, 'login']);
  
Route::group(['middleware' => 'jwt.verify'], function () {
    Route::post('logout', [JwtAuthController::class, 'logout']);
    Route::get('user-info', [JwtAuthController::class, 'getUser']);
  
    Route::resource('atributos', AtributosController::class);
    Route::resource('atributo_valores', AtributoValoresController::class);
    Route::resource('estoques', EstoquesController::class);
    Route::resource('produtos', ProdutosController::class);
    Route::resource('produto_variacoes', ProdutoVariacoesController::class);
});


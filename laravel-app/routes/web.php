<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LivroController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\AuthSimpleController;

Route::get('/', function(){ return redirect()->route('livros.index'); });

Route::get('login', [AuthSimpleController::class,'showLogin'])->name('login');
Route::post('login', [AuthSimpleController::class,'loginProcess']);
Route::post('logout', [AuthSimpleController::class,'logout'])->name('logout');

Route::middleware(['simple.auth'])->group(function(){
    Route::resource('categorias', CategoriaController::class)->except(['show']);
    Route::resource('livros', LivroController::class)->except(['show']);
});

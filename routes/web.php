<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Principal
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/all', [HomeController::class, 'all'])->name('home.all');

//Articulos
Route::get('/articles',[ArticleController::class,'index'])->name('articles.index');
Route::get('/articles/create',[ArticleController::class,'create'])->name('articles.create');
Route::post('/articles',[ArticleController::class,'store'])->name('articles.store');


<?php

use App\Application\Controllers\HomeController;
use App\Application\Controllers\ImportFileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')
    ->group(function () {
        Route::get('/upload', [ImportFileController::class, 'uploadView'])->name('upload-view');
        Route::post('/upload', [ImportFileController::class, 'upload'])->name('upload');
    });

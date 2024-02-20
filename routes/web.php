<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;


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
    return view('/welcome');
});

Route::get('/dashboard', [BlogController::class, 'showBlogs'] )->name('dashboard')->middleware('auth');;

Route::get('/createblog', [BlogController::class, 'create'] )->name('createblog')->middleware('auth');

// site functions
Route::post('/createBlog', [BlogController::class, 'createBlog'])->name('createBlog')->middleware('auth');

Route::post('/likePost/{id}/{user_id}', [BlogController::class, 'likePost'])->name('likePost')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\FollowsController;

//use App\Mail\NewUserWelcomeEmail;

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


Auth::routes();

// Route::get('/email', function ()
// {
// 	return new NewUserWelcomeEmail();
// });

Route::get('/', [PostsController::class, 'index']);

Route::get('/profile/{id}', [ProfilesController::class, 'index'])->name('profile.show');
Route::get('/profile/edit/{id}', [ProfilesController::class, 'edit'])->name('profile.edit');
Route::patch('/profile/{id}', [ProfilesController::class, 'update'])->name('profile.update');

Route::get('/post/create', [PostsController::class, 'create'])->name('post.create');
Route::post('/post', [PostsController::class, 'store'])->name('post.store');
Route::get('/post/{id}', [PostsController::class, 'show'])->name('post.show');

//follow route
Route::post('/follow/{id}', [FollowsController::class, 'store']);

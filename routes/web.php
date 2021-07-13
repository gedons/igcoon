<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\FollowsController;
use App\Http\Controllers\LikesController;
use App\Http\Controllers\CommentsController;


use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProfileController;



//use App\Mail\NewUserWelcomeEmail;


Auth::routes();

// Route::get('/email', function ()
// {
// 	return new NewUserWelcomeEmail();
// });


//admin Routes
	
Route::prefix('/admin')->namespace('Admin')->group(function ()
{
	//login
	Route::get('/', [AdminController::class, 'login']);
	Route::post('login', [AdminController::class, 'loginAdmin'])->name('admin.login');

	//middleware group route that guards the admin dashboard
	Route::group(['middleware'=>['admin']],function ()
	{
		Route::get('dashboard', [AdminController::class, 'dashboard']);
		Route::get('userprofiles', [ProfileController::class, 'userprofile'])->name('admin.userprofile');
		Route::get('userprofile/{id}', [ProfileController::class, 'viewUserprofile'])->name('admin.viewUserprofile');
		Route::post('updateProfilestatus', [ProfileController::class, 'updateProfilestatus']);
		Route::post('verifyProfilestatus', [ProfileController::class, 'verifyProfilestatus']);


		Route::get('logout', [AdminController::class, 'logout'])->name('admin.logout');
	});
	
});

//end admin


//front route
Route::get('/', [PostsController::class, 'index']);

//profile routes
Route::get('/profile/{id}', [ProfilesController::class, 'index'])->name('profile.show');
Route::get('/profile/edit/{id}', [ProfilesController::class, 'edit'])->name('profile.edit');
Route::patch('/profile/{id}', [ProfilesController::class, 'update'])->name('profile.update');

//post routes
Route::get('/post/create', [PostsController::class, 'create'])->name('post.create');
Route::post('/post', [PostsController::class, 'store'])->name('post.store');
Route::get('/post/{id}', [PostsController::class, 'show'])->name('post.show');
Route::get('/post/edit/{id}', [PostsController::class, 'edit'])->name('post.edit');
Route::patch('/post/update/{id}', [PostsController::class, 'update'])->name('post.update');
Route::post('/delete-post/{id}', [PostsController::class, 'delete'])->name('post.delete');

//comment route
Route::post('/post/comment/{id}', [CommentsController::class, 'create'])->name('comment.create');

//follow route
Route::post('/follow/{id}', [FollowsController::class, 'store']);

//likes route
Route::post('/like/{id}', [LikesController::class, 'store']);


//end front
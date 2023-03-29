<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoListController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;

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


Route::get('/', [HomeController::class, 'index']);



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



// Blog routes
Route::get('/blog', 'App\Http\Controllers\BlogController@index')->name('blog.index');
Route::get('/blog/create', 'App\Http\Controllers\BlogController@create')->name('blog.create');
Route::post('/blog', 'App\Http\Controllers\BlogController@store')->name('blog.store');
Route::get('/blog/{id}', 'App\Http\Controllers\BlogController@show')->name('blog.show');
Route::get('/blog/{id}/edit', 'App\Http\Controllers\BlogController@edit')->name('blog.edit');
Route::put('/blog/{id}', 'App\Http\Controllers\BlogController@update')->name('blog.update');
Route::get('/blog/{id}/delete', 'App\Http\Controllers\BlogController@delete')->name('blog.delete');
Route::delete('/blog/{id}', 'App\Http\Controllers\BlogController@destroy')->name('blog.destroy');
Route::get('/search', 'App\Http\Controllers\BlogController@search')->name('blog.search');
Route::post('/blog/{id}/like', 'App\Http\Controllers\BlogController@like')->name('blog.like');
Route::delete('/posts/{id}/unlike', 'App\Http\Controllers\BlogController@unlike')->name('blog.unlike');


// Comment routes
Route::post('/blog/{id}/comments', 'App\Http\Controllers\CommentController@store')->name('comments.store');
Route::get('/blog/{id}/comments/{comment_id}/edit', 'App\Http\Controllers\CommentController@edit')->name('comments.edit');
Route::put('/blog/{id}/comments/{comment_id}', 'App\Http\Controllers\CommentController@update')->name('comments.update');
Route::get('/blog/{id}/comments/{comment_id}', 'App\Http\Controllers\CommentController@destroy')->name('comments.destroy');

//Profile Routes
Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');
Route::get('/profile/{user}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile/{user}', [ProfileController::class, 'update'])->name('profile.update');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/todo', [TodoListController::class, 'index'])->middleware('auth')->name('todolist.index');
Route::post('/saveItemRoute', [TodoListController::class, 'saveItem'])->name('saveItem');
Route::post('/markDone/{id}', [TodoListController::class, 'markDone'])->name('markDone');

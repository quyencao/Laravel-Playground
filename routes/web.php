<?php

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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/test', function () {
   $comment = \App\Comment::find(4)->comments()->get();

   return $comment;
});

Route::get('/comments', 'CommentController@index')->name('comment');
Route::get('/get/comments', 'CommentController@getComments');

Route::post('/add/comment', 'CommentController@add')->name('comment.add');
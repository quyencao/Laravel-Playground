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

Route::get('article', 'ArticleController@index');
Route::post('article', 'ArticleController@store')->name('article');
Route::get('article/{article_id}/{tag}', 'ArticleController@untag')->name('article.untag');
Route::get('article/{tag}', 'ArticleController@getArticleByTag')->name('tag.article');
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



Auth::routes();
Route::group(['middleware'=>['web','auth']], function(){
    Route::get('/home', 'HomeController@check');
    Route::get('user', 'UserController@index');
    Route::get('user/{id}/edit','UserController@edit');
    Route::get('user/{id}/editprofile','UserController@editprofile');
});
Route::post('register', 'Auth\RegisterController@store_avatar');
Route::get('profile/{user}', 'UserController@profile');

Route::post('user', 'UserController@store');
Route::get('user/{id}/delete', 'UserController@destroy');
Route::get('user/create', 'UserController@create');
Route::put('user/{id}/updateprofile','UserController@updateprofile');
Route::put('user/{id}/update','UserController@update');

Route::resource('forum','ForumController');
Route::get('/', 'ForumController@index');
Route::post('search', 'ForumController@search');
Route::get('master', 'ForumController@indexmaster');
Route::get('forum/{forum}/delete', 'ForumController@destroy');
Route::get('forum/{forum}/close', 'ForumController@close');
Route::get('myforum/{user}', 'MyforumController@index');

Route::get('thread/{forum}', 'ThreadController@index');
Route::post('thread/{forum}/searchthread', 'ThreadController@searchthread');
Route::post('thread/{forum}?search_keyword={thread}'. 'ThreadController@search_thread');
Route::post('thread/{forum}', 'ThreadController@store');
Route::get('thread/{id}/edit', 'ThreadController@edit');
Route::put('thread/{id}/update', 'ThreadController@update');
Route::get('thread/{id}/delete', 'ThreadController@destroy');

Route::get('vote/{giver}/{receiver}/{type}', 'VoterRelationshipController@create');

Route::get('message/{user}','MessageController@index');
Route::post('message/{user}','MessageController@store');
Route::get('message/{id}/delete','MessageController@destroy');
Route::get('message/reply/{id}/{message_id}','MessageController@reply');
Route::post('message/reply/{id}','MessageController@sendReply');

Route::get('category', 'CategoryController@index');
Route::post('category', 'CategoryController@store');
Route::get('category/{category}/edit', 'CategoryController@edit');
Route::put('category/{category}/update', 'CategoryController@update');
Route::get('category/{category}/delete', 'CategoryController@destroy');

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


/* Aunthentication Routes */
Auth::routes();
/* Custom Register Route */
Route::post('register', 'Auth\RegisterController@store');

/* Resource Route */
Route::resource('user', 'UserController');
Route::resource('forum','ForumController');
Route::resource('category', 'CategoryController');

/* Middleware Group of Web and Auth Validation Route */
Route::group(['middleware'=>['web','auth']], function(){
    /* User Index Route */
    Route::get('user', 'UserController@index');
    /* Show Create User Form Route from Admin Perspective */
    Route::get('user/create', 'UserController@create');
    /* Create User Route from Admin Perspective */
    Route::post('user', 'UserController@store');
    /* User Profile Show Route */
    Route::get('profile/{user_id}', 'UserController@show');
    /* Show Edit Form for User Profile Route */
    Route::get('profile/{user_id}/edit', 'UserController@edit');
    /* Show Edit Form for User Route from Admin Perspective */
    Route::get('user/{user_id}/edit', 'UserController@editUser');
    /* Update User Profile Route */
    Route::put('profile/{user_id}/update', 'UserController@update');
    /* Update User Route from Admin Perspective */
    Route::put('user/{user_id}/update', 'UserController@updateUser');
    /* Delete User Route from Admin Perspective */
    Route::get('user/{user_id}/delete', 'UserController@destroy');
    
    /* Forum List Index Route from Admin Perspective */
    Route::get('forum-admin', 'ForumController@indexAdmin');
    /* Delete Forum Route from Admin Persepective */
    Route::get('forum/{forum_id}/delete', 'ForumController@destroy');
	/* Close Forum Route */
    Route::get('forum/{forum_id}/close', 'ForumController@close');
    
    /* My Forum User Index Route */
    Route::get('myforum/{user_id}/{user_name}', 'MyForumController@show');

    /* Category Index Route from Admin Persepective */
    Route::get('category', 'CategoryController@index');
    /* Create Category Route from Admin Perspective */
    Route::post('category', 'CategoryController@create');
    /* Show Edit Form for Category Route from Admin Perspective */
	Route::get('category/{category_id}/edit', 'CategoryController@edit');
    /* Update Category Route from Admin Persepective */
	Route::put('category/{category_id}/update', 'CategoryController@update');
	/* Delete Category Route from Admin Persepective */
    Route::get('category/{category_id}/delete', 'CategoryController@destroy');
    
    /* Store New Thread Route from Opened Forum */
    Route::post('thread/{forum_id}/store', 'ThreadController@store');
    /* Show Edit Form for Thread Route */
    Route::get('thread/{thread_id}/edit', 'ThreadController@edit');
	/* Update Thread Route */
    Route::put('thread/{thread_id}/update', 'ThreadController@update');
	/* Delete Thread Route */
    Route::get('thread/{thread_id}/delete', 'ThreadController@destroy');

    /* Give Vote Route */
	Route::get('vote/{sender_id}/{receiver_id}/{status}', 'VoterController@store');

    /* Message Index Route */
	Route::get('message/{user_id}/{user_name}', 'MessageController@index');
	/* Store New Message to another User Route */
    Route::post('message/{receiver_id}', 'MessageController@store');
	/* Message Delete Route */
    Route::get('message/{id}/delete', 'MessageController@destroy');
});

/* Home Route or Forum Index Route */
Route::get('/', 'ForumController@index')->name('home');
/* Forum Search Route */
Route::post('forum/search', 'ForumController@search');
Route::get('/forum/0/search={search}', 'ForumController@searchForum');

/* Thread Index Route */
Route::get('thread/{forum_id}', 'ThreadController@index');
/* Thread Search Route */
Route::post('thread/{forum_id}/search', 'ThreadController@search');
Route::get('thread/{forum_id}/search={search}', 'ThreadController@searchThread');




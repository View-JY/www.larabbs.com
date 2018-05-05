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

Route::get('/', 'HomeController@index') ->name('index');

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('/users/all', 'UsersController@all') ->name('users.all');
Route::get('/users/{user}/followings', 'UsersController@followings')->name('users.followings');
Route::get('/users/{user}/followers', 'UsersController@followers')->name('users.followers');
Route::resource('users', 'UsersController', ['only' => ['show', 'update', 'edit']]);

Route::post('followers/{user}', 'FollowersController@store')->name('followers.store');
Route::delete('followers/{user}', 'FollowersController@destroy')->name('followers.destroy');

Route::get('topics/zan/{topic}', 'TopicsController@zan') ->name('topics.zan');
Route::get('topics/unzan/{topic}', 'TopicsController@unzan') ->name('topics.unzan');
Route::get('topics/bookmark/{topic}', 'TopicsController@bookmark') ->name('topics.bookmark');
Route::get('topics/unbookmark/{topic}', 'TopicsController@unbookmark') ->name('topics.unbookmark');
Route::resource('topics', 'TopicsController', ['only' => ['index', 'show', 'create', 'store', 'update', 'edit', 'destroy']]);

Route::resource('categories', 'CategoriesController', ['only' => ['show']]);

Route::post('upload_image', 'TopicsController@uploadImage')->name('topics.upload_image');

Route::get('replies/replyzan/{reply}', 'RepliesController@replyzan') ->name('replies.replyzan');
Route::get('replies/unreplyzan/{reply}', 'RepliesController@unreplyzan') ->name('replies.unreplyzan');
Route::resource('replies', 'RepliesController', ['only' => ['store', 'destroy']]);

Route::resource('notifications', 'NotificationsController', ['only' => ['index']]);

Route::get('zans/{topic}', 'ZansController@show') ->name('zans.show');

Route::get('bookmark/{user}', 'BookmarksController@show') ->name('bookmarks.show');

Route::get('/help', 'HelpController@index') ->name('help.index');
Route::post('/help/create', 'HelpController@create') ->name('help.create');

// 照片墙
Route::get('/photos', 'PhotosController@index') ->name('photos.index');
Route::get('/photos/show/{phototype}', 'PhotosController@show') ->name('photos.show');
Route::post('/photos/create', 'PhotosController@create') ->name('photos.create');
Route::post('/photos/createtype', 'PhotosController@createtype') ->name('photos.createtype');
Route::get('/photos/deletetype/{phototype}', 'PhotosController@deletetype') ->name('photos.deletetype');
Route::get('/photos/deletephoto/{photo}', 'PhotosController@deletephoto') ->name('photos.deletephoto');
Route::get('/photos/downphoto', 'PhotosController@downphoto') ->name('photos.downphoto');
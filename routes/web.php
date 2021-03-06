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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::group(['middleware' => ['auth']], function(){
   Route::post('favorite/{post}/add', 'FavoriteController@add')->name('post.favorite');
});

Route::post('subscriber', 'SubscriberController@store')->name('subscriber.store');

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['as' =>'admin.', 'prefix' => 'admin', 'namespace' => 'admin', 'middleware' => ['auth', 'admin']], function(){
	Route::get('dashboard', 'DashboardController@index')->name('dashboard');
	Route::resource('tag', 'TagController');
	Route::resource('category', 'CategoryController');
	Route::resource('post', 'PostController');

    Route::get('settings', 'SettingsController@index')->name('settings');
	Route::put('profile-update', 'SettingsController@updateProfile')->name('profile.update');
    Route::put('password-update', 'SettingsController@updatePassword')->name('password.update');


    Route::put('/post/{id}/approve', 'PostController@approval')->name('post.approve');
	Route::get('pending/post', 'PostController@pending')->name('post.pending');

    Route::get('/favorite', 'FavoriteController@index')->name('favorite.index');
	Route::get('/subscriber', 'SubscriberController@index')->name('subscriber.index');
	Route::delete('/subscriber/{id}', 'SubscriberController@destroy')->name('subscriber.destroy');
});


Route::group(['as' =>'author.', 'prefix' => 'author', 'namespace' => 'author', 'middleware' => ['auth', 'author']], function(){
	Route::get('dashboard', 'DashboardController@index')->name('dashboard');

    Route::get('settings', 'SettingsController@index')->name('settings');
    Route::put('profile-update', 'SettingsController@updateProfile')->name('profile.update');
    Route::put('password-update', 'SettingsController@updatePassword')->name('password.update');

	Route::resource('post', 'PostController');

});

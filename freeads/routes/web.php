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

Route::get('/', "IndexController@showIndex")->name('home');
Route::get('/home', "IndexController@showIndex");

Route::post('/search', 'SearchController@searchShow');
Route::get('/search', 'SearchController@show');
Route::post('/search/filtered', 'SearchController@search');
Route::get('/search/filtered', 'SearchController@search');
Route::get('/advert/{id}', 'AdvertisementController@show');

Auth::routes();
 
Route::get('/confirm/{token}', 'Auth\RegisterController@confirmation');

Route::group(['middleware' => 'auth'], function () { 

	Route::get('/profil/{id}', 'IndexController@show');
	Route::get('/profil/{id}/delete', 'IndexController@delete');
	Route::get('/profil/{id}/edit', 'IndexController@edit');
	Route::post('/profil/{id}/update', 'IndexController@update');

	Route::get('/advert', 'AdvertisementController@create');
	Route::post('/advert/post', 'AdvertisementController@store');
	Route::get('/advert/{id}/delete', 'AdvertisementController@delete');
	Route::get('/advert/{id}/edit', 'AdvertisementController@edit');
	Route::post('/advert/{id}/update', 'AdvertisementController@update');

	Route::get('/message/{id}', 'MessagesController@create');
	Route::get('/message', 'MessagesController@show');
	Route::post('/message/{id}/send', 'MessagesController@store');
	Route::post('/message/answer', 'MessagesController@answer');
});

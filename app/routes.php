<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'HomeController@findLangAndRedirect');

Route::group(['prefix' => '/{lang}', 'before' => 'lang'], function() 
{
	Route::get('/clean/{id}', [
		'as' => 'strip.clean',
		'uses' => 'StripController@clean'
	]);
	Route::get('/translate/{id}', [
		'as' => 'strip.translate',
		'uses' => 'StripController@translate'
	]);
	Route::get('/import', [
		'as' => 'strip.import',
		'uses' => 'StripController@import'
	]);
});

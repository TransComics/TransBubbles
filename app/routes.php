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

Route::when('*', 'csrf', array('post', 'put', 'delete'));

Route::pattern('id', '[0-9]+');

Route::get('/', [
        'as' => 'home.index',
        'uses' => 'HomeController@index'
]);
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

Route::get('comics/list', [
    'as' => 'comics.list',
    'uses' => 'ComicsController@getList'
]);

Route::group(['prefix' => '/comic'], function() {
    Route::get('/add', [
        'as' => 'comic.add',
        'uses' => 'ComicController@addForm',
    ]);    
    Route::get('/update/{id}', [
        'as' => 'comic.update',
        'uses' => 'ComicController@updateForm',
    ]);
    Route::put('/add', 'ComicController@add');
    Route::post('/update/{id}', 'ComicController@update');
    Route::delete( '/delete/{id}', [
        'as' => 'comic.delete',
        'uses' => 'ComicController@delete',
    ]);
});
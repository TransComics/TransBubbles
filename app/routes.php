<?php

/*
 * |--------------------------------------------------------------------------
 * | Application Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register all of the routes for an application.
 * | It's a breeze. Simply tell Laravel the URIs it should respond to
 * | and give it the Closure to execute when that URI is requested.
 * |
 */

Route::pattern('id', '[0-9]+');
Route::when('*', 'csrf', [
    'post',
    'put',
    'delete'
]);

Route::get('/', [
    'as' => 'home',
    'uses' => 'HomeController@home'
]);
Route::get('/clean/{id}', [
    'as' => 'strip.clean',
    'uses' => 'StripController@clean'
]);
Route::get('/translate/{id}', [
    'as' => 'strip.translate',
    'uses' => 'StripController@translate'
]);
Route::get('/login/', [
    'as' => 'user.signIn',
    'uses' => 'UsersController@getLogin'
]);
Route::get('/logout/', [
    'as' => 'user.logout',
    'uses' => 'UsersController@getLogout'
]);
Route::post('/login/', 'UsersController@postLogin');
Route::get('/signup/', [
    'as' => 'users.signUp',
    'uses' => 'UsersController@getRegister'
]);
Route::post('/signup/', 'UsersController@postCreate');

Route::group(['prefix' => '/password'], function() {
    Route::get('/remind', [
        'uses' => 'RemindersController@getRemind',
        'as' => 'password.remind'
    ]);
    Route::post('/remind', 'RemindersController@postRemind');
    Route::get('/reset/{token}', [
        'uses' => 'RemindersController@getReset',
        'as' => 'password.reset'
    ]);
    Route::post('/reset', 'RemindersController@postReset');
});

Route::get('comics/list', [
    'as' => 'comics.list',
    'uses' => 'ComicsController@getList'
]);

Route::group(['prefix' => '/comic'], function () {
    Route::get('/add', [
        'as' => 'comic.add',
        'uses' => 'ComicController@addForm'
    ]);
    Route::get('/update/{id}', [
        'as' => 'comic.update',
        'uses' => 'ComicController@updateForm'
    ]);
    Route::put('/add', 'ComicController@add');
    Route::post('/update/{id}', 'ComicController@update');
    Route::delete('/delete/{id}', [
        'as' => 'comic.delete',
        'uses' => 'ComicController@delete'
    ]);
});

Route::group(['prefix' => '/ws'], function () {
    Route::get('/strip/{id}/shapes', 'ShapesController@getAllForStrip');
    Route::post('/strip/{id}/shapes', 'ShapesController@setAllForStrip');
    Route::get('/strip/{id}/bubbles/{lang}', 'BubblesController@getAll');
    Route::post('/strip/{id}/bubble/{lang}', 'BubblesController@setAll');
});

Route::resource('strips', 'StripsController');

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
Route::get('/login/', [
    'as' => 'users.signIn',
    'uses' => 'UsersController@getLogin'
]);
Route::get('/logout/', [
    'as' => 'users.signIn',
    'uses' => 'UsersController@getLogout'
]);
Route::post('/login/', [
    'as' => 'users.signIn',
    'uses' => 'UsersController@postLogin'
]);
Route::get('/signup/', [
    'as' => 'users.signUp',
    'uses' => 'UsersController@getRegister'
]);
Route::post('/signup/', [
    'as' => 'users.signUp',
    'uses' => 'UsersController@postCreate'
]);

Route::get('password/remind', [
    'uses' => 'RemindersController@getRemind',
    'as' => 'password.remind'
]);
Route::post('password/remind', [
    'uses' => 'RemindersController@postRemind',
    'as' => 'password.remind'
]);
Route::get('password/reset/{token}', [
    'uses' => 'RemindersController@getReset',
    'as' => 'password.reset'
]);
Route::post('password/reset/', [
    'uses' => 'RemindersController@postReset'
]);
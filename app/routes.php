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

/* Constraint */
Route::pattern('id', '[0-9]+');
Route::pattern('comic_id', '[0-9]+');
Route::when('*', 'csrf', ['post', 'put', 'delete']);

/* Home Page */
Route::get('/', [
    'as' => 'home',
    'uses' => 'HomeController@home'
]);

Route::post('/lang', [
    'as' => 'language.select',
    'uses' => 'LanguageController@select'
]);


/* Authentification */
Route::get('/login/', [
    'as' => 'user.signin',
    'uses' => 'UsersController@getLogin'
]);
Route::get('/logout/', [
    'as' => 'user.logout',
    'uses' => 'UsersController@getLogout'
]);
Route::post('/login/', 'UsersController@postLogin');
Route::get('/signup/', [
    'as' => 'users.signup',
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

Route::group(['prefix' => '/comic/{comic_id}/strip'], function() {
    Route::get('/{id}', [
        'as' => 'strip.show',
        'uses' => 'StripController@show'
    ]);
    Route::get('/', [
        'as' => 'strip.index',
        'uses' => 'StripController@index'
    ]);
    Route::post('/store', [
        'as' => 'strip.store',
        'uses' => 'StripController@store'
    ]);
    Route::put('/{id}', [
        'as' => 'strip.update',
        'uses' => 'StripController@update'
    ]);
    Route::get('/{id}/edit/', [
        'as' => 'strip.edit',
        'uses' => 'StripController@edit'
    ]);
    Route::get('/', [
        'as' => 'strip.create',
        'uses' => 'StripController@create'
    ]);
    Route::delete('/{id}', [
        'as' => 'strip.destroy',
        'uses' => 'StripController@destroy'
    ]);
    Route::get('/clean/{id}', [
        'as' => 'strip.clean',
        'uses' => 'StripController@clean'
    ]);
    Route::put('/{id}/saveClean', [
        'as' => 'strip.saveClean',
        'uses' => 'StripController@saveClean'
    ]);
    Route::get('/{id}/translate', [
        'as' => 'strip.translate',
        'uses' => 'StripController@translate'
    ]);
    Route::get('/import/{id}', [
        'as' => 'strip.import',
        'uses' => 'StripController@import'
    ]);
    
    /*Route::put('/pending/{id}', [
        'as' => 'strip.validStrip',
        'uses' => 'StripsController@validPending'
    ]);
    Route::put('/pending/{id}', [
        'as' => 'strip.validClean',
        'uses' => 'StripsController@validPending'
    ]);
    Route::put('/pending/{id}', [
        'as' => 'strip.validImportText',
        'uses' => 'StripsController@validPending'
    ]);
    Route::put('/pending/{id}', [
        'as' => 'strip.validTraduction',
        'uses' => 'StripsController@validPending'
    ]);*/
});

Route::get('comics/list', [
    'as' => 'comics.list',
    'uses' => 'ComicsController@getList'
]);

Route::group(['before' => 'auth', 'prefix' => '/comic'], function () {
    Route::get('/add', [
        'as' => 'comic.add',
        'uses' => 'ComicController@addForm'
    ]);
    Route::get('/update/{id}', [
        'as' => 'comic.update',
        'uses' => 'ComicController@updateForm'
    ]);
    Route::post('/add', 'ComicController@add');
    Route::put('/update/{id}', 'ComicController@update');
    Route::delete('/delete/{id}', [
        'as' => 'comic.delete',
        'uses' => 'ComicController@delete'
    ]);
});

Route::group(['prefix' => '/ws'], function () {
    Route::resource('/translate', 'TranslatorController',array('only' => array('update')));
});

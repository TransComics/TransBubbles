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
Route::when('*', 'csrf', [
    'post',
    'put',
    'delete'
]);

/* Home Page */
Route::get('/', [
    'as' => 'home',
    'uses' => 'HomeController@home'
]);

Route::post('/lang', [
    'as' => 'language.select',
    'uses' => 'LanguageController@select'
]);

Route::post('/strip/lang', [
    'as' => 'strip.lang',
    'uses' => 'LanguageController@selectForStrip'
]);

Route::post('/strip/lang_to', [
    'as' => 'strip.lang_to',
    'uses' => 'LanguageController@selectForStripTo'
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
    'as' => 'user.signup',
    'uses' => 'UsersController@getRegister'
]);
Route::post('/signup/', 'UsersController@postCreate');

Route::group([
    'prefix' => '/password'
], function () {
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

Route::group([
    'prefix' => '/comic/{comic_id}/strip'
], function () {
    Route::get('/{id}', [
        'as' => 'strip.show',
        'uses' => 'StripController@show'
    ]);
    Route::get('/', [
        'as' => 'strip.index',
        'uses' => 'StripController@index'
    ]);
    
    Route::get('/{id}/vote', [
        'as' => 'strip.vote',
        'uses' => 'VoteController@index'
    ]);
    
    Route::post('/{id}/vote', [
        'as' => 'strip.postvote',
        'uses' => 'VoteController@store'
    ]);
    
    // Fix maison à modifier
    Route::post('/create', [
        'as' => 'strip.store',
        'uses' => 'StripController@store'
    ]);
    // Fix maison, à modifier
    Route::put('/{id}/edit', [
        'as' => 'strip.update',
        'uses' => 'StripController@update'
    ]);
    Route::get('/{id}/edit', [
        'as' => 'strip.edit',
        'uses' => 'StripController@edit'
    ]);
    Route::get('/create', [
        'as' => 'strip.create',
        'uses' => 'StripController@create'
    ]);
    Route::delete('/{id}', [
        'as' => 'strip.destroy',
        'uses' => 'StripController@destroy'
    ]);
    
    Route::get('/{id}/clean', [
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
    Route::put('/{id}/saveTranslate', [
        'as' => 'strip.saveTranslate',
        'uses' => 'StripController@saveTranslate'
    ]);
    
    Route::get('/{id}/import', [
        'as' => 'strip.import',
        'uses' => 'StripController@import'
    ]);
    Route::put('/{id}/saveImport', [
        'as' => 'strip.saveImport',
        'uses' => 'StripController@saveImport'
    ]);
    
    /*
     * Route::put('/pending/{id}', [
     * 'as' => 'strip.validStrip',
     * 'uses' => 'StripsController@validPending'
     * ]);
     * Route::put('/pending/{id}', [
     * 'as' => 'strip.validClean',
     * 'uses' => 'StripsController@validPending'
     * ]);
     * Route::put('/pending/{id}', [
     * 'as' => 'strip.validImportText',
     * 'uses' => 'StripsController@validPending'
     * ]);
     * Route::put('/pending/{id}', [
     * 'as' => 'strip.validTraduction',
     * 'uses' => 'StripsController@validPending'
     * ]);
     */
});

Route::resource('/comic', 'ComicController', [
    'before' => 'auth'
]);

Route::group([
    'prefix' => '/ws'
], function () {
    Route::resource('/translate', 'TranslatorController', array(
        'only' => array(
            'update'
        )
    ));
});

Route::get('/access/denied', ['as' => 'access.denied', 'uses' => function () { return "ACCESS DENIED";}]);

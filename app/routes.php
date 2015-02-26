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

/* Languages */
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

Route::get('/verify/{confirmation_code}', [
    'as' => 'user.verify',
    'uses' => 'UsersController@verify'
]);

Route::get('/verify', [
    'as' => 'user.verify_index',
    'uses' => 'UsersController@verifyIndex'
]);

Route::post('/verify', [
    'as' => 'user.verify_index',
    'uses' => 'UsersController@postVerify'
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
Route::group(['prefix' => '/private', 'before' => 'super_admin'], function() {
    Route::resource('/roles', 'RoleController');
        
    Route::delete('/roles/{role_id}/{roleRessource_id}', [
        'as' => 'roles.user.destroy',
        'uses' => 'RoleController@removeUserRole'
    ]);
    
    Route::post('/roles/{role_id}/', [
        'as' => 'roles.storeUserRole',
        'uses' => 'RoleController@storeUserRole'
    ]);
    
    Route::get('/export', [
    'as' => 'private.export',
    'uses' => 'ExportController@export'
    ]);
});

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

Route::group(['prefix' => '/comic/{comic}/strip'], function () {
    Route::get('/{id}', [
        'as' => 'strip.show',
        'uses' => 'StripController@show'
    ]);
    Route::get('/', [
        'as' => 'strip.index',
        'uses' => 'StripController@index'
    ]);
    Route::get('/moderate/{strip_id}', [
        'as' => 'strip.moderate',
        'uses' => 'StripController@indexModerate',
        'before' => 'access'
    ]);

    Route::post('/moderate/{strip_id}', [
        'as' => 'strip.select',
        'uses' => 'StripController@moderate',
        'before' => 'access'
    ]);
    
    Route::get('/moderateShape/{shape_id}', [
    'as' => 'strip.moderateShape',
    'uses' => 'StripController@indexModerateShape',
    'before' => 'access'
    ]);
    
    Route::post('/moderateShape/{shape_id}', [
    'as' => 'strip.selectShape',
    'uses' => 'StripController@moderateShape',
    'before' => 'access'
    ]);
    
    Route::get('/moderateImport/{import_id}', [
    'as' => 'strip.moderateImport',
    'uses' => 'StripController@indexModerateImport',
    'before' => 'access'
    ]);
    
    Route::post('/moderateImport/{import_id}', [
    'as' => 'strip.selectImport',
    'uses' => 'StripController@moderateImport',
    'before' => 'access'
    ]);
    
    Route::get('/moderateBubble/{bubble_id}', [
    'as' => 'strip.moderateBubble',
    'uses' => 'StripController@indexModerateBubble',
    'before' => 'access'
    ]);
    
    Route::post('/moderateBubble/{bubble_id}', [
    'as' => 'strip.selectBubble',
    'uses' => 'StripController@moderateBubble',
    'before' => 'access'
    ]);
    

    Route::get('/{id}/vote/{bubble_id?}', [
        'as' => 'strip.vote',
        'uses' => 'VoteController@index'
    ]);

    Route::post('/{id}/vote/{bubble_id}', [
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
});

Route::group(['prefix' => '/comic'], function () {
    Route::get('/moderate', [
        'as' => 'comic.moderate',
        'uses' => 'ComicController@indexModerate',
        'before' => 'super_admin'
    ]);
    Route::post('/moderate', [
        'as' => 'comic.select',
        'uses' => 'ComicController@moderate',
        'before' => 'super_admin'
    ]);
});

Route::get('/comic/{comic}/role', [
    'as' => 'comic.role',
    'uses' => 'RoleRessourceController@index',
    'before' => 'comic_admin'
]);

Route::post('/comic/{comic}/role', [
    'as' => 'comic.role.create',
    'uses' => 'RoleRessourceController@store',
    'before' => 'comic_admin'
]);

Route::delete('/comic/{comic}/role/{roleR_id}', [
    'as' => 'comic.role.destroy',
    'uses' => 'RoleRessourceController@destroy',
    'before' => 'comic_admin'
]);

Route::resource('/comic', 'ComicController');
Route::group([
    'prefix' => '/ws'], function () {
    Route::resource('/translate', 'TranslatorController', array('only' => array('update')));
    Route::resource('/popularities', 'PopularitiesController', array('only' => array('update')));
    Route::get('/getUsers', 'UsersController@getUsers');

});

Route::get('/access/denied', ['as' => 'access.denied', 'uses' => function () {
        return "ACCESS DENIED";
    }]);

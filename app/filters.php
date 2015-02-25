<?php

/*
 * |--------------------------------------------------------------------------
 * | Application & Route Filters
 * |--------------------------------------------------------------------------
 * |
 * | Below you will find the "before" and "after" events for the application
 * | which may be used to do any work before or after a request into your
 * | application. Here you may also register your custom route filters.
 * |
 */
App::before(function ($request) {

    /* Define language. */
    if (Session::has('lang')) {
        $lang = Session::get('lang');
    } else {
        $lang = substr(Request::server('HTTP_ACCEPT_LANGUAGE'), 0, 2);
    }
    /* Define user locale. */
    App::setLocale($lang);

    /* Give languages to View. */

    View::share([
        'languages' => Language::all([
            'shortcode',
            'label'
        ])
    ]);
});

App::after(function ($request, $response) {
//
});

/*
 * |--------------------------------------------------------------------------
 * | Authentication Filters
 * |--------------------------------------------------------------------------
 * |
 * | The following filters are used to verify that the user of the current
 * | session is logged into this application. The "basic" filter easily
 * | integrates HTTP Basic authentication for quick, simple checking.
 * |
 */

Route::filter('auth', function () {
    if (Auth::guest()) {
        if (Request::ajax()) {
            return Response::make('Unauthorized', 401);
        } else {
            return Redirect::guest('login');
        }
    }
});

Route::filter('auth.basic', function () {
    return Auth::basic();
});

Route::filter('access', function($route) {
    if (Auth::check()) {
        return RoleRessource::filter($route);
    }
});

Route::filter('super_admin', function ($route) {
    if (Auth::check() && !Auth::user()->isSuperAdministrator()) {
        return Redirect::route('access.denied');
    }
});

Route::filter('comic_admin', function ($route) {
    if(!Auth::check()) {
        return Redirect::route('user.signin');
    }
    if(Auth::user()->isComicAdmin($route)) {
        return;
    }
    if(Auth::user()->isSuperAdministrator()) {
        return;
    }
    
    return Redirect::route('access.denied');
});

/*
 * |--------------------------------------------------------------------------
 * | Guest Filter
 * |--------------------------------------------------------------------------
 * |
 * | The "guest" filter is the counterpart of the authentication filters as
 * | it simply checks that the current user is not logged in. A redirect
 * | response will be issued if they are, which you may freely change.
 * |
 */

Route::filter('guest', function () {
        if (Auth::check())
            return Redirect::route('home')->withMessage('You are already logged in!');
});

/*
 * |--------------------------------------------------------------------------
 * | CSRF Protection Filter
 * |--------------------------------------------------------------------------
 * |
 * | The CSRF filter is responsible for protecting your application against
 * | cross-site request forgery attacks. If this special token in a user
 * | session does not match the one given in this request, we'll bail.
 * |
 */

Route::filter('csrf', function () {
    $token = Request::ajax() ? Request::header('X-CSRF-Token') : Input::get('_token');
    if (Session::token() !== $token) {
        throw new Illuminate\Session\TokenMismatchException();
    }
});

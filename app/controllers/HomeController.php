<?php
class HomeController extends Controller {
	
	/*
	 * |--------------------------------------------------------------------------
	 * | Default Home Controller
	 * |--------------------------------------------------------------------------
	 * |
	 * | You may wish to use controllers instead of, or in addition to, Closure
	 * | based routes. That's great! Here is an example controller method to
	 * | get you started. To route to this controller, just add the route:
	 * |
	 * | Route::get('/', 'HomeController@showWelcome');
	 * |
	 */
	public function findLangAndRedirect() {
		return Redirect::route ( 'home.index', [ 
				'lang' => substr ( Request::server ( 'HTTP_ACCEPT_LANGUAGE' ), 0, 2 ) 
		] );
	}
	public function index() {
		return View::make ( 'index' );
	}
}

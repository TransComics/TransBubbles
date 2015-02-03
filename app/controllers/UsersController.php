<?php
class UsersController extends Controller {
	public function __construct() {
		$this->beforeFilter ( 'csrf', array (
				'on' => 'post' 
		) );
	}
	public function getLogin() {
		return View::make ( 'users.signIn' );
	}
	public function getRegister() {
		return View::make ( 'users.signUp' );
	}
	public function postCreate() {
		$validator = Validator::make ( Input::all (), User::$rules );
		
		if ($validator->passes ()) {
			// validation has passed, save user in DB
			$user = new User ();
			$user->username = Input::get ( 'username' );
			$user->email = Input::get ( 'email' );
			$user->password = Hash::make ( Input::get ( 'password' ) );
			$user->save ();
			
			return Redirect::route ( 'home.index', [ 
					'message' => 'Register OK' 
			] );
		} else {
			// validation has failed, display error messages
			return Redirect::to ( 'users.signUp' )->with ( 'message', 'The following errors occurred' )->withErrors ( $validator )->withInput ();
		}
	}
	public function postSignin() {
		if (Auth::attempt ( array (
				'email' => Input::get ( 'email' ),
				'password' => Input::get ( 'password' ) 
		) )) {
			// Login has passed
			return Redirect::to ( 'home.index' )->with ( 'message', 'You are now logged in!' );
		} else {
			return Redirect::to ( 'users.signIn' )->with ( 'message', 'Your username/password combination was incorrect' )->withInput ();
		}
	}
	
	public function getLogout() {
		Auth::logout();
		return Redirect::to('home.index')->with('message', 'Your are now logged out!');
	}
}
?>
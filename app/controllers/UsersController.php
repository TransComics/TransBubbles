<?php

class UsersController extends Controller {

    public function __construct() {
        $this->beforeFilter('csrf', array(
            'on' => 'post'
        ));
        $this->beforeFilter('guest', array(
            'on' => [
                'getLogin'
            ]
        ));
    }

    public function getLogin() {
        return View::make('user.signin');
    }

    public function getRegister() {
        return View::make('user.signup');
    }

    public function postCreate() {
        $validator = Validator::make(Input::all(), User::$rules);
        
        if ($validator->passes()) {
            // validation has passed, save user in DB
            $user = new User();
            $user->username = Input::get('username');
            $user->email = Input::get('email');
            $user->password = Hash::make(Input::get('password'));
            $user->save();
            
            return Redirect::route('user.signin')->with('success', Lang::get('login.registration_succes'));
        } else {
            // validation has failed, display error messages
            return Redirect::back()->with('message', Lang::get('login.message_errors'))
                ->withErrors($validator)
                ->withInput();
        }
    }

    public function postLogin() {
        if (Auth::attempt(array(
            'email' => Input::get('email'),
            'password' => Input::get('password')
        ), Input::has('remember'))) {
            // Login has passed
            return Redirect::route('home')->with('message', Lang::get('login.logged_in'));
        } else {
            return Redirect::back()->with('message', Lang::get('login.error_post_login'))->withInput();
        }
    }

    public function getLogout() {
        Auth::logout();
        return Redirect::back()->with('message', Lang::get('login.logged_out'));
    }
}
?>

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
        Form::setValidation(User::$rules);
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
            
            $confirmation_code = str_random(30);
            $user->confirmation_code = $confirmation_code;
            
            Mail::send('emails.verify_mail', [
                'confirmation_code' => $confirmation_code
            ], function ($message) {
                $message->to(Input::get('email'), Input::get('username'))->subject(Lang::get('login.verify_mail_subject'));
            });
            
            $user->save();
            
            return Redirect::route('user.signin')->with('success', Lang::get('login.registration_to_verify'));
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
            'password' => Input::get('password'),
            'confirmed' => true
        ), Input::has('remember'))) {
            // Login has passed
            return Redirect::intended('/')->with('message', Lang::get('login.logged_in'));
        } else {
            return Redirect::back()->with('message', Lang::get('login.error_post_login'))->withInput();
        }
    }

    public function getUsers() {
        $query = Input::get('name_startsWith') . '%';
        if (Request::ajax()) {
            $users = User::where('username', 'LIKE', $query)->get();
            return Response::json([
                'username' => $users->toArray()
            ]);
        }
    }

    public function getLogout() {
        Auth::logout();
        return Redirect::back()->with('message', Lang::get('login.logged_out'));
    }

    public function verifyIndex() {
        return View::make('emails.verify');
    }

    public function postVerify() {
        $email = Input::get('email');
        if (empty($email)) {
            return Redirect::back()->withError(Lang::get('validation.required', [
                'attribute' => 'email'
            ]));
        }
        $user = User::whereemail($email)->first();
        
        if (empty($user) || $user->confirmed) {
            return Redirect::back()->withError(Lang::get('login.incorrect_mail'))->withInput();
        }
        $confirmation_code = str_random(30);
        $user->confirmation_code = $confirmation_code;
        
        Mail::send('emails.verify_mail', [
            'confirmation_code' => $confirmation_code
        ], function ($message) use($user) {
            $message->to(Input::get('email'), $user->username)->subject(Lang::get('moderate.verify_mail_subject'));
        });
        
        $user->save();
        
        return Redirect::route('user.signin')->with('success', Lang::get('login.registration_to_verify'));
    }

    public function verify($confirmation_code = null) {
        if (is_null($confirmation_code)) {
            App::abort(404);
        }
        
        $user = User::whereconfirmation_code($confirmation_code)->first();
        
        if (! $user) {
            App::abort(404);
        }
        $user->confirmed = true;
        $user->confirmation_code = null;
        $user->save();
        
        return Redirect::route('user.signin')->with('success', Lang::get('login.registration_succes'));
    }
}
?>

<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use \Transcomics\RoleRessource\RoleRessource;

class User extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait,
        RemindableTrait;

    public static $rules = array(
        'username' => 'required|alpha_num|unique:users|min:3',
        'email' => 'required|email|unique:users',
        'password' => 'required|between:6,24|confirmed',
//        'password_confirmation' => 'required'
    );

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array(
        'password',
        'remember_token'
    );
    protected $errors;

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier() {
        return $this->getKey();
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword() {
        return $this->password;
    }

    /**
     * Get the e-mail address where password reminders are sent.
     *
     * @return string
     */
    public function getReminderEmail() {
        return $this->email;
    }

    public function getRememberTokenName() {
        return "remember_token";
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param string $value            
     * @return void
     */
    public function setRememberToken($value) {
        $this->remember_token = $value;
    }

    public function getRememberToken() {
        return $this->remember_token;
    }

    public function shapes() {
        return $this->hasMany('Shape');
    }

    public function isSuperAdministrator() {
        $result = RoleRessource::select()
                ->whererole_id(1)
                ->whereuser_id($this->id)
                ->first();
        return !empty($result);
    }

    public function isComicAdmin($route) {
        $result = RoleRessource::select()
                ->whereressource(Transcomics\RoleRessource\RessourceDefinition::Comics)
                ->whereressource_id($route->getParameter('comic'))
                ->whereuser_id($this->id)
                ->first();
        return !empty($result);
    }

}

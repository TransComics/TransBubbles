<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Transcomics\RoleRessource\RessourceDefinition;

class User extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait,
        RemindableTrait;

    public static $rules = array(
        'username' => 'required|alpha_num|unique:users|min:3',
        'email' => 'required|email|unique:users',
        'password' => 'required|between:6,24|confirmed',
        'password_confirmation' => 'required'
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
    
    public function comics() {
        return $this->hasMany('Comic');
    }

    public function isSuperAdministrator() {
        $result = RoleRessource::select()
                ->whererole_id(1)
                ->whereuser_id($this->id)
                ->first();
        return !empty($result);
    }

    /**
     * Check if we are the comic administrator 
     * We check if we are superAdministrator too
     * @param type $route
     * @return boolean
     */
    public function isComicAdmin($route) {
        $comic_id = $route->getParameter('comic');
        return $this->isComicAdminWithID($comic_id);
    }
    
    public function isComicAdminWithID($comic_id) {
        if ($this->isSuperAdministrator()) {
            return true;
        }

        $result = RoleRessource::select()
                ->whereressource(Transcomics\RoleRessource\RessourceDefinition::Comics)
                ->whereressource_id($comic_id)
                ->whereuser_id($this->id)
                ->where('role_id', 2)
                ->first();
        return !empty($result);
    }
    
    public function isComicModerator($comic_id) {
        if ($this->isSuperAdministrator()) {
            return true;
        }
        
        return RoleRessource::isAllowed('M', RessourceDefinition::Comics, $comic_id, \Auth::id());
    }

}

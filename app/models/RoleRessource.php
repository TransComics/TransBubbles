<?php

namespace Transcomics\RoleRessource;

use Role;
use Strip;
use User;
use Comic;

class RoleRessource extends \Eloquent {

    protected $guarded = ['id'];
    protected $table = 'roles_ressources';
    public $timestamps = false;

    /**
     * Add or update the access right to the user on the specified ressource
     * @param type $role_id
     * @param type $ressource
     * @param type $ressource_id
     * @param type $user_id
     * @return Boolean true if the right is added, false otherwise
     */
    public function addRight($role_id, $ressource, $ressource_id, $user_id) {
        if (!RessourceDefinition::isValidValue($ressource)) {
            return false;
        }

        $role = Role::find($role_id);
        if ($role == NULL) {
            return false;
        }

        $user = User::find($user_id);
        if ($user == NULL) {
            return false;
        }

        $role_ressource = RoleRessource::whereuser_id($user_id)
                ->whereressource($ressource)
                ->whereressource_id($ressource_id)
                ->first();

        if (empty($role_ressource)) {
            $role_ressource = new RoleRessource();
        }

        $role_ressource->role_id = $role_id;
        $role_ressource->user_id = $user_id;
        $role_ressource->ressource = $ressource;
        $role_ressource->ressource_id = $ressource_id;
        return $role_ressource->save();
    }

    public function removeRight($roleRessource_id) {

        $row = RoleRessource::find($roleRessource_id);

        if (empty($row)) {
            return false;
        }
        //FIXME : what is the return ?
        $row->delete();
        return true;
    }

    private function canAccessRessource($role_desc, $ressource, $ressource_id, $user_id) {

        if (!RessourceDefinition::isValidValue($ressource)) {
            return \Redirect::route('access.denied');
        }

        $userRessourceAccesRight = RoleRessource::whereuser_id($user_id)
                ->whereressource($ressource)
                ->whereressource_id($ressource_id)
                ->first();

        // We don't know the access
        if (empty($userRessourceAccesRight)) {
            return 'UNKNOWN';
        }

        $userRessourceRoles = Role::findOrFail($userRessourceAccesRight->role_id);
        return $userRessourceRoles->$role_desc;
    }

    private function getVisitorRights($role_desc) {
        $guestRoles = Role::findOrFail(4);
        return $guestRoles->$role_desc;
    }

    private function getComicId($strip_id) {
        return Strip::findOrFail($strip_id)->comic->id;
    }

    public function isAllowed($role_desc, $ressource, $ressource_id, $user_id) {

        if (!RessourceDefinition::isValidValue($ressource)) {
            return \Redirect::route('access.denied');
        }

        if (!\Auth::check()) {
            return $this->getVisitorRights($role_desc);
        }

        if (User::find($user_id)->isSuperAdministrator()) {
            return true;
        }

        switch ($this->canAccessRessource($role_desc, $ressource, $ressource_id, $user_id)) {
            case 'UNKNOWN':
                if ($ressource == RessourceDefinition::Strips) {
                    $comic_id = $this->getComicId($ressource_id);
                    return $this->isAllowed($role_desc, RessourceDefinition::Comics, $comic_id, $user_id);
                } else {

                    return $this->getVisitorRights($role_desc);
                }
                break;

            case true:
                return true;

            case false:
                return false;
        }
    }

    private function getAccessMode($routeName) {
        // Getting the access mode : C,R,U,(M),D
        if (preg_match('/.create$|.store$/', $routeName)) {
            return 'C';
        }

        if (preg_match('/.show$/', $routeName)) {
            return 'R';
        }

        if (preg_match('/.edit$|.update$/', $routeName)) {
            return 'U';
        }

        if (preg_match('/.destroy$/', $routeName)) {
            return 'D';
        }

        if (preg_match('/.moderate$|.select$/', $routeName)) {
            return 'M';
        }
    }

    public function filter($route) {
        // We get the route name (ressource.xxxxx)
        $routeName = \Route::getCurrentRoute()->getName();

        $access_mode = $this->getAccessMode($routeName);

        if (empty($access_mode)) {
            return;
        }

        if ($access_mode == 'M') {
            $comic_id = $route->getParameter('comic');
            if (!$this->isAllowed($access_mode, RessourceDefinition::Comics, $comic_id, \Auth::id())) {
                return \Redirect::route('access.denied');
            } else {
                return;
            }
        }

        // Getting the ressource type
        if (preg_match('/^strip./', $routeName)) {
            // Get Strip right
            $strip_id = $route->getParameter('id');
            if (!$this->isAllowed($access_mode, RessourceDefinition::Strips, $strip_id, \Auth::id())) {
                return \Redirect::route('access.denied');
            }
        } elseif (preg_match('/^comic./', $routeName)) {
            // Get Comic right
            $comic_id = $route->getParameter('comic');
            if (!$this->isAllowed($access_mode, RessourceDefinition::Comics, $comic_id, \Auth::id())) {
                return \Redirect::route('access.denied');
            }
        }
    }

}

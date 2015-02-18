<?php

namespace Transcomics\RoleRessource;

use Role;
use Strip;
use Comic;

class RoleRessource extends \Eloquent {

    protected $guarded = ['id'];
    protected $table = 'roles_ressources';
    public $timestamps = false;

    /**
     * Add the access right to the user on the specified ressource
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

        $role_ressource = new RoleRessource();
        $role_ressource->role_id = $role_id;
        $role_ressource->user_id = $user_id;
        $role_ressource->ressource = $ressource;
        $role_ressource->ressource_id = $ressource_id;
        return $role_ressource->save();
    }

    private function checkRessource($ressource) {
        if (!RessourceDefinition::isValidValue($ressource)) {
            // TODO : Retourner la vue qui affiche erreur !
            return 'ERROR';
        }
    }

    private function canAccessRessource($role_desc, $ressource, $ressource_id, $user_id) {
        $this->checkRessource($ressource);

        $userRessourceAccesRight = RoleRessource::whereuser_id($user_id)
                ->whereressource($ressource)
                ->where('ressource_id', 'LIKE', $ressource_id)
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
        $this->checkRessource($ressource);

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

            case 'ERROR':
                //TODO : Voir checkRessource
                $ret = 'ERROR';
                break;
        }
    }

    //TODO : Move to private when function refactore above ;)
    public function getAccessMode($routeName) {
        // Getting the access mode : C,R,U,(M),D
        if (preg_match('/.create$|.store$/', $routeName)) {
            return 'C';
        } elseif (preg_match('/.show$/', $routeName)) {
            return 'R';
        } elseif (preg_match('/.edit$|.update$/', $routeName)) {
            return 'U';
        } elseif (preg_match('/.destroy$/', $routeName)) {
            return 'D';
        }
    }

}

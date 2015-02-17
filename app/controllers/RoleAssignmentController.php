<?php

abstract class Ressource {

// Credit : http://stackoverflow.com/questions/254514/php-and-enumerations
    private static $constCacheArray = NULL;

    const Comics = 1;
    const Strips = 2;

    private static function getConstants() {
        if (self::$constCacheArray == NULL) {
            self::$constCacheArray = [];
        }
        $calledClass = get_called_class();
        if (!array_key_exists($calledClass, self::$constCacheArray)) {
            $reflect = new ReflectionClass($calledClass);
            self::$constCacheArray[$calledClass] = $reflect->getConstants();
        }
        return self::$constCacheArray[$calledClass];
    }

    public static function isValidName($name, $strict = false) {
        $constants = self::getConstants();

        if ($strict) {
            return array_key_exists($name, $constants);
        }

        $keys = array_map('strtolower', array_keys($constants));
        return in_array(strtolower($name), $keys);
    }

    public static function isValidValue($value) {
        $values = array_values(self::getConstants());
        return in_array($value, $values, $strict = true);
    }

}

class RoleAssignmentController extends BaseController {

    /**
     * Add the access right to the user on the specified ressource
     * @param type $role_id
     * @param type $ressource
     * @param type $ressource_id
     * @param type $user_id
     * @return Boolean true if the right is added, false otherwise
     */
    public function addRight($role_id, $ressource, $ressource_id, $user_id) {
        if (!Ressource::isValidValue($ressource)) {
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
        if (!Ressource::isValidValue($ressource)) {
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
        $guestRoles = Role::findOrFail(2);
        return $guestRoles->$role_desc;
    }

    public function isAllowed($role_desc, $ressource, $ressource_id, $user_id) {
        $this->checkRessource($ressource);
        
        switch ($this->canAccessRessource($role_desc, $ressource, $ressource_id, $user_id)) {
            case 'UNKNOWN':
                if ($ressource == Ressource::Strips) {
                    return isAllowed($role_desc, Ressource::Comics, $ressource_id, $user_id);
                } else {
                    return $this->getVisitorRights($role_desc);
                }
                break;

            case true:
                return true;

            case false:
                return false;

            case 'ERROR':
                $ret = 'ERROR';
                break;
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        //
    }

}

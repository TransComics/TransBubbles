<?php

use Transcomics\RoleRessource\RessourceDefinition;

class RoleController extends BaseController {

    public function __construct() {
        $this->beforeFilter('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        return View::make('role.index')->with('roles', Role::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return View::make('role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $rules = array(
            'name' => 'required|unique:roles|alpha_num'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            Log::info('into store fail' . $validator->messages());
            return Redirect::back()->withErrors($validator)->withInput();
        } else {

            $role = new Role();
            $role->name = Input::get('name');
            $role->C = Input::has('c') ? 1 : 0;
            $role->R = Input::has('r') ? 1 : 0;
            $role->U = Input::has('u') ? 1 : 0;
            $role->M = Input::has('m') ? 1 : 0;
            $role->D = Input::has('d') ? 1 : 0;
            $role->save();

            Log::info('saving role');

            return Redirect::route('private..roles.index')->with('message', Lang::get('rote.created'));
        }
    }

    /**
     * Update or create user role
     * @param type $role_id : The role ID impacted by the update
     */
    public function storeUserRole($role_id) {
        $rules = array(
            'name' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            Log::info('into store fail' . $validator->messages());
            return Redirect::back()->withErrors($validator);
        }

        $role = Role::find($role_id);
        if ($role == NULL) {
            Log::info('unknown role $role_id');
// TODO : Create lang
            return Redirect::back()->withError(Lang::get('role.errorUpdatingRole'));
        }

        $user = User::whereusername(Input::get('name'))->first();
        if (empty($user)) {
            Log::info('invalid user' . Input::get('name'));
//Todo : Create message
            return Redirect::back()->withError(Lang::get('role.errorUpdatingRole'));
        }

        $result = RoleRessource::addRight($role_id, RessourceDefinition::All, RessourceDefinition::All, $user->id);

        if ($result) {
// Getting new table to update
            $role_ressources = RoleRessource::whererole_id($role->id)->get();
            return View::make('role.show', [
                        'role' => $role,
                        'role_ressources' => $role_ressources,
            ]);
        } else {
            Log::info('unknown error when adding/updating userRole : addRight return false');
            return Redirect::back()->withError(Lang::get('role.errorUpdatingRole'));
        }
    }

    public function removeUserRole($role_id, $roleRessource_id) {

        $role = Role::find($role_id);
        if ($role == null) {
            return Redirect::route('access.denied');
        }

        $roleRessource = RoleRessource::find($roleRessource_id);

        if (is_null($roleRessource)) {
            return Redirect::route('private..roles.show', $role_id)
                            ->withError(Lang::get('role.errorDeleteRole'));
        }

        $filteredRoleRessource = RoleRessource::whererole_id($role_id)
                ->where('id', $roleRessource_id)
                ->get();

        if ($filteredRoleRessource == null) {
            return Redirect::route('access.denied');
        }

        if (RoleRessource::removeRight($roleRessource_id)) {
            return Redirect::route('private..roles.show', $role_id)
                            ->withMessage(Lang::get('role.added'));
        } else {
            Log::info('unknown error when removing userRole : removeRight returned false with role_id : $role_id');
            return Redirect::route('private..roles.show', $role_id)
                            ->withError(Lang::get('role.cannot_suppress'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id            
     * @return Response
     */
    public function edit($id) {
        $role = Role::find($id);
        if ($role == null) {
            return Redirect::route('home');
        }

        return View::make('role.edit', [
                    'role' => $role
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id            
     * @return Response
     */
    public function show($id) {
        $role = Role::find($id);
        if ($role == null) {
            return Redirect::route('home');
        }

        $role_ressources = RoleRessource::whererole_id($role->id)->get();

        if ($role_ressources == null) {
            return Redirect::route('home');
        }

        return View::make('role.show', [
                    'role' => $role,
                    'role_ressources' => $role_ressources,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id            
     * @return Response
     */
    public function update($id) {
        $role = Role::find($id);
        if ($role == null) {
            return Redirect::route('home');
        }
        $role->C = Input::has('c') ? 1 : 0;
        $role->R = Input::has('r') ? 1 : 0;
        $role->U = Input::has('u') ? 1 : 0;
        $role->M = Input::has('m') ? 1 : 0;
        $role->D = Input::has('d') ? 1 : 0;
        $role->save();

        return Redirect::route('private..roles.index')->with('message', Lang::get('rote.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id            
     * @return Response
     */
    public function destroy($id) {
        $role = Role::find($id);
        if ($role == null) {
            return Redirect::route('home');
        }
        $rolename = $role->name;
        if ($role->protected) {
            return Redirect::route('private..roles.index')->with('message', Lang::get('role.cannot_suppress', [
                                'rolename' => $rolename
            ]));
        }
        $role->delete();
        return Redirect::route('private..roles.index')->with('message', Lang::get('role.destroy', [
                            'rolename' => $rolename
        ]));
    }
}

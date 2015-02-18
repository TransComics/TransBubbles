<?php

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
            'name' => 'required|unique:roles'
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
            'role_ressources' => $role_ressources
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
        $role->delete();
        return Redirect::route('private..roles.index')->with('message', Lang::get('role.destroy') - with($rolename));
    }
}

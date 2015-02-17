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
            'value' => 'required|unique'
        );
        $validator = Validator::make(Input::all(), $rules);
          
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        } else {
            $role = new Role();
            $role->name = Input::get('name');
            $role->c = Input::has('c') ;
            $role->r = Input::has('r') ;
            $role->u = Input::has('u') ;
            $role->m = Input::has('m') ;
            $role->d = Input::has('d') ;
            $role->save();
            
            return Redirect::route('private..role.index')->with('message', Lang::get('rote.created'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id            
     * @return Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id            
     * @return Response
     */
    public function update($id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id            
     * @return Response
     */
    public function destroy($id) {
        //
    }
}

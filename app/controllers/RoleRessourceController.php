<?php

use Transcomics\RoleRessource\RessourceDefinition;
class RoleRessourceController extends BaseController {

    public function __construct() {
        $this->beforeFilter('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id) {  
        $comic = Comic::find($id);
        if($comic == null){
            return Redirect::route('home');
        }
        
        $rolesR = RoleRessource::whereressource(RessourceDefinition::Comics)->whereressource_id($id)->get();
        if($rolesR == null){
            return Redirect::route('home');
        }
        
        $role = Role::all(['id','name'])->filter(function($r){
            if($r->id == 1 || $r->id ==4){
                return false;
            }
            return true;
        }
        )->lists('name','id');
  
        return View::make('comic.role')->with('rolesR',$rolesR)->with('comic',$comic)->with('role',$role);  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store($id) {
        $comics = Comic::find($id);
        if($comics == null){
            return Redirect::route('home');
        }
        $rules = array(
            'name' => 'required',
            'role' => 'required'
        );
        
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            Log::info('into store fail' . $validator->messages());
            return Redirect::back()->withErrors($validator)->withInput();
        }
        $role = Input::get('role');
        $user_id = User::whereusername(Input::get('name'))->first()->id;
        
        RoleRessource::addRight($role,RessourceDefinition::Comics,$id,$user_id);
        
        return Redirect::route('comic.role')->withMessage(Lang::get('role.added'));
        
    }
}

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
        if ($comic == null) {
            return Redirect::route('home');
        }
        
        $rolesR = RoleRessource::whereressource(RessourceDefinition::Comics)->whereressource_id($id)->get();
        if ($rolesR == null) {
            return Redirect::route('home');
        }
        
        $role = $this->getFilteredRoles();
        
        return View::make('comic.role')->with('rolesR', $rolesR)
            ->with('comic', $comic)
            ->with('role', $role);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store($id) {
        $comic = Comic::find($id);
        if ($comic == null) {
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
        $roleArray = $this->getFilteredRoles();
            
        if (!array_key_exists($role, $roleArray)) {
            return Redirect::route('access.denied');
        }
        
        $rolesR = RoleRessource::whereressource(RessourceDefinition::Comics)->whereressource_id($id)->get();
        if ($rolesR == null) {
            return Redirect::route('home');
        }
        
        $user_id = User::whereusername(Input::get('name'))->first()->id;
        
        //Check if user is the comic creator
        if ($user_id == $comic->created_by) {
            return Redirect::route('comic.role', $comic->id)->withMessage(Lang::get('role.cannot_suppress'))
            ->with('rolesR', $rolesR)
            ->with('comic', $comic)
            ->with('role', $roleArray);
        }
                
        //grant right
        RoleRessource::addRight($role, RessourceDefinition::Comics, $id, $user_id);
         
        return Redirect::route('comic.role', $comic->id)->withMessage(Lang::get('role.added'))
            ->with('rolesR', $rolesR)
            ->with('comic', $comic)
            ->with('role', $roleArray);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function destroy($comic_id, $roleR_id) {
        $comic = Comic::find($comic_id);
        if ($comic == null) {
            return Redirect::route('home');
        }
        $roleR = RoleRessource::find($roleR_id);
        if ($roleR == null) {
            return Redirect::route('home');
        }
        
        $role = $this->getFilteredRoles();
        $rolesR = RoleRessource::whereressource(RessourceDefinition::Comics)->whereressource_id($comic_id)->get();
        
        if ($roleR->user_id == $comic->created_by) {
            return Redirect::route('comic.role', $comic->id)->withMessage(Lang::get('role.cannot_suppress'))
                ->with('rolesR', $rolesR)
                ->with('comic', $comic)
                ->with('role', $role);
        }
        
        $roleR->delete();
        
        return Redirect::route('comic.role', $comic->id)->withMessage(Lang::get('role.user_deleted'))
            ->with('rolesR', $rolesR)
            ->with('comic', $comic)
            ->with('role', $role);
    }

    private function getFilteredRoles() {
        return Role::all()->filter(function ($r) {
            if ($r->id == 1 || $r->id == 4) {
                return false;
            }
            return true;
        })
            ->each(function ($o) {
            
            $o->name .= ' (';
            if ($o->C) {
                $o->name .= 'C';
            }
            if ($o->R) {
                $o->name .= 'R';
            }
            if ($o->U) {
                $o->name .= 'U';
            }
            if ($o->M) {
                $o->name .= 'M';
            }
            if ($o->D) {
                $o->name .= 'D';
            }
            $o->name .= ')';
        })
            ->lists('name', 'id');
    }
}

<?php

class StripController extends BaseController {
    
    /**
     * show strip used by the controller.
     *
     * @return void
     */
    protected function show($id) {
        $strip = Strips::find($id);
        if ($strip == null) {
            return Redirect::route('strip.index');
        }
        return View::make('strip.show', ['strips' => $strip]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() { // modifier une fois comics implémenté : Guillaume
        return View::make('strip.index', ['strips' => Strips::all()]);
    }
    
    
    public function edit($id) {
        $this->beforeFilter('auth');
        
        $strip = Strips::find($id);
        if ($strip == null) {
            return Redirect::route('strip.index');
        }
        return View::make('strip.create_edit', ['strips' => $strip]);
    } 
    
    public function create() {
        $this->beforeFilter('auth');
        
        return View::make('strip.create_edit', ['strip' => new Strips()]);
    } 
    
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        $this->beforeFilter('auth');
        
        $valid = Validator::make(['title' => Input::get('title')], Strips::$updateRules);

        $strip = Strips::find($id);
        if ($strip == null) {
            return Redirect::back()->withInput()->withErrors($v);
        }

        if ($valid->passes()) {
            $strip->title = Input::get('title');
            $strip->updated_at = new DateTime();
            $strip->save();
        } else {
            return Redirect::back()->with('message', Lang::get('strips.updateFailure'))
                            ->withErrors($v)
                            ->withInput();
        }
        return Redirect::back()->with('message', Lang::get('strips.editComplete'));
    }

    /**
     * Add a newly created resource in storage.
     *
     * @param Request $request 
     * @return Response
     */
    public function store() {
        $this->beforeFilter('auth');
        
        $valid = Validator::make(Input::all(), Strips::$rules);
        if ($valid->fails()) {
            return Redirect::back()->withInput()->withErrors($v);
        } else {
            $file = Input::file('strip');
            $fileLocation = UploadFile::uploadFile($file);

            $strip = new Strips();
            $strip->title = Input::get('title');
            $strip->path = $fileLocation;
            $strip->validated_at = NULL;
            $strip->save();
            return Redirect::route('strip.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        $this->beforeFilter('auth');
        
        $strip = Strips::find($id);
        if ($strip == null) {
            return Redirect::route('strip.index');
        }
        UploadFile::dropFile($strip->path);
        $strip->delete();
        return Redirect::back()->with('message', Lang::get('strips.deleteSucceded'));
    }

    /**
     * import strip used by the controller.
     *
     * @return void
     */
    protected function import() {
        return View::make('strip.import');
    }

    /**
     * clean strip used by the controller.
     *
     * @return void
     */
    protected function clean() {
        return View::make('strip.clean');
    }

    /**
     * translate strip used by the controller.
     *
     * @return void
     */
    protected function translate() {
        return View::make('strip.translate', [
                    'fonts' => Font::all()->lists('name', 'name')
        ]);
    }
    
    /*public function listPending() {
        $strips = Strips::whereNull('validated_at')->get();
        return View::make('strips.list', ['strips' => $strips]);
    }

    public function validPending() {
        $strip = Strips::find(Input::get('id'));
        if ($strip == null) {
            return Redirect::back()->withInput()->withErrors($v);
        }
        $strip->updated_at = new DateTime();
        $strip->validated_at = new DateTime();
        $strip->save();

        return Redirect::back()->with('message', Lang::get('strips.approved'));
    }*/
}

?>
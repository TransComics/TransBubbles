<?php

class StripsController extends BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        return View::make('strip.import');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request 
     * @return Response
     */
    public function store() {

        $file = Input::file('strip');
        if ($file->isValid()) {
            $destinationPath = 'uploads';
            // TODO : The method to choose wich name we are gonna choose
            //$extension =$file->getClientOriginalExtension(); 
            $upload_success = Input::file('strip')->move($destinationPath, $filename);
            if ($upload_success) {
                return Redirect::back()->with('success', Lang::get('strip.uploadComplete'));
            } else {
                return Redirect::back()->with('message', Lang::get('strip.uploadFailed'))->withInput();
            }
        } else {
            return Redirect::back()->with('message', Lang::get('CHOISI UN FICHIER'))->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        
    }

}

?>
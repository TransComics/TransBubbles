<?php

class StripsController extends BaseController {

    /**
     * Instantiate a new UserController instance.
     */
    public function __construct() {
        $this->beforeFilter('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        return View::make('strip.update', [ 'isAdd' => true, 'strips' => new Strips()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request 
     * @return Response
     */
    public function store() {

        $v = Validator::make(Input::all(), Strips::$rules);
        if ($v->fails()) {
            return Redirect::back()->withInput()->withErrors($v);
        } else {
            $file = Input::file('strip');
            $fileLocation = UploadFile::uploadFile($file);

            $strip = new Strips();
            $strip->title = Input::get('title');
            $strip->path = $fileLocation;
            $strip->validated_at = NULL;
            $strip->save();
            return Redirect::route('strips.pending');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $s = Strips::find($id);
        if ($s == null) {
            return Redirect::route('strips.index');
        }
        return View::make('strip.update', ['isAdd' => false, 'strips' => $s]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        $v = Validator::make(['title' => Input::get('title')], Strips::$updateRules);

        $strip = Strips::find($id);
        if ($strip == null) {
            return Redirect::back()->withInput()->withErrors($v);
        }

        if ($v->passes()) {
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        $strip = Strips::find($id);
        if ($strip == null) {
            return Redirect::route('strips.index');
        }
        UploadFile::dropFile($strip->path);
        $strip->delete();
        return Redirect::back()->with('message', Lang::get('strips.deleteSucceded'));
    }

    public function listPending() {
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
    }

}

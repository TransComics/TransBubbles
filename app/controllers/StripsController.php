<?php

class StripsController extends BaseController {

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
            if ($file->isValid()) {
                $fileLocation = UploadFile::uploadFile($file);

                $strip = new Strips();
                $strip->title = Input::get('title');
                $strip->path = $fileLocation;
                $strip->save();
                return Redirect::back()->with('message', Lang::get('strips.uploadComplete'));
            } else {
                return Redirect::back()->with('message', Lang::get('strip.unvalidFile'))->withInput();
            }
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

        // If the button we press to get here is delete, we redirect to delete
        if (Input::get('delete')) {
            return $this->destroy($id);
        }

        $v = Validator::make(['title' => Input::get('title')], Strips::$updateRules);
        if ($v->passes()) {
            $strip = Strips::find($id);
            if ($strip == null) {
                return Redirect::route('strips.index');
            }
            $strip->title = Input::get('title');
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
        return Redirect::route('strips.index')->with('message', Lang::get('strips.deleteSucceded'));
    }
}
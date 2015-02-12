<?php

class StripController extends BaseController {

    public function __construct() {
        $this->beforeFilter('auth', ['except' => ['index']]);
    }

    /**
     * show strip used by the controller.
     *
     * @return void
     */
    protected function show($comic_id, $id) {
        $strip = Strip::find($id);
        if ($strip == null) {
            return Redirect::route('comic.index');
        }
        return View::make('strip.show', ['strips' => $strip]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($comic_id) {
        $comic = Comic::find($comic_id);
        if ($comic == null) {
            return Redirect::route('comic.index');
        }
        return View::make('strip.index', ['strips' => $comic->strips]);
    }

    public function edit($comic_id, $id) {
        $strip = Strip::find($id);
        if ($strip == null) {
            return Redirect::route('comic.index');
        }
        return View::make('strip.edit', ['strips' => $strip]);
    }

    public function create() {
        return View::make('strip.create', ['strips' => new Strip()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id_comic, $id) {
        $valid = Validator::make(['title' => Input::get('title')], Strip::$updateRules);

        $strip = Strip::find($id);
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
        $valid = Validator::make(Input::all(), Strip::$rules);
        if ($valid->fails()) {
            return Redirect::back()->withInput()->withErrors($v);
        } else {
            $file = Input::file('strip');
            $fileLocation = UploadFile::uploadFile($file);

            $strip = new Strip();
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
    public function destroy($comic_id, $id) {
        $strip = Strip::find($id);
        if ($strip == null) {
            return Redirect::route('comic.index');
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
    protected function clean($strip_id) {
        $strip = Strip::find($strip_id);
        if ($strip == null) {
            return Redirect::route('home');
        }

        View::share([
            'shape' => Shape::where('strip_id', '=', $strip->id)->get()->first(),
            'strip' => $strip,
        ]);

        return View::make('strip.clean');
    }

    protected function saveClean($strip_id) {
        if (!Strip::exists($strip_id)) {
            return Redirect::route('home');
        }

        $shape = Shape::find(Input::get('id'));
        if ($shape == null) {
            $shape = new Shape();
        } else if (Auth::check() && $shape->user_id != Auth::user()->id) {
            return Redirect::route('home');
        }

        $shape->strip_id = $strip_id;
        $shape->value = Input::get('value');
        if (Auth::check()) {
            $shape->user_id = Auth::user()->id;
        }
        $shape->save();

        return Redirect::route('strip.clean', [$strip_id]);
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

    /* public function listPending() {
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
      } */
}

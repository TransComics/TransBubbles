<?php

class StripController extends BaseController {

    public function __construct() {
        $this->beforeFilter('auth', ['except' => ['index', 'show', 'clean', 'import', 'translate']]);
    }

    /**
     * show strip used by the controller.
     *
     * @return void
     */
    protected function show($comic_id, $id) {
        $comic = Comic::find($comic_id);
        if ($comic == null) {
            return Redirect::route('comic.index');
        }

        $strip = $comic->strips->find($id);
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

        if ($comic->strips->count() < 1) {
            return Redirect::route('comic.index');
        }

        return View::make('strip.index', ['strips' => $comic->strips, 'comic_id' => $comic_id]);
    }

    public function edit($comic_id, $id) {
        $comic = Comic::find($comic_id);
        if ($comic == null) {
            return Redirect::route('comic.index');
        }

        $strip = $comic->strips->find($id);
        if ($strip == null) {
            return Redirect::route('comic.index');
        }

        return View::make('strip.edit', ['strips' => $strip]);
    }

    public function create($comic_id) {
        return View::make('strip.create', ['strips' => new Strip(), 'comic_id' => $comic_id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($comic_id, $id) {
        $valid = Validator::make(['title' => Input::get('title')], Strip::$updateRules);

        $comic = Comic::find($comic_id);
        if ($comic == null) {
            return Redirect::route('comic.index');
        }

        $strip = $comic->strips->find($id);
        if ($strip == null) {
            return Redirect::route('comic.index');
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
     * @param Request $comic_id 
     * @return Response
     */
    public function store($comic_id) {
        $files = Input::file('strips');
        
        foreach ($files as $file) {
            $valid = Validator::make(['strip' => $file, 'title' => Input::get('title_')], Strip::$rules);
            if ($valid->fails()) {
                return Redirect::back()->withInput()->withErrors($valid);
            } else {
                $fileLocation = UploadFile::uploadFile($file);

                $strip = new Strip();
                $strip->title = Input::get('title_1');
                $strip->path = $fileLocation;
                $strip->validated_at = NULL;
                $strip->comic_id = $comic_id;
                $strip->save();
            }
        }
        return Redirect::route('strip.index', ['comic_id' => $comic_id])->with('message', Lang::get('strip.uploadComplete'));
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
    protected function import($comic_id, $strip_id) {
        $strip = Strip::find($strip_id);
        if ($strip == null) {
            return Redirect::route('home');
        }
        
        $shape = Shape::find($strip_id);
        if ($shape == null) {
            $shape = new Shape();
        } else if (Auth::check() && $shape->user_id != Auth::user()->id) {
            return Redirect::route('home');
        }
        
        View::share([
            'fonts' => Font::all()->lists('name', 'name'),
            'strip' => $strip,
            'shape' => $shape
        ]);
        
        return View::make('strip.import', [
                'fonts' => Font::all()->lists('name', 'name')
        ]);
    }

    /**
     * clean strip used by the controller.
     *
     * @return void
     */
    protected function clean($comic_id, $strip_id) {
        $strip = Strip::find($strip_id);
        if ($strip == null) {
            return Redirect::route('home');
        }

        $shape = $strip->shapes->first();
        View::share([
            'shape' => $shape != null ? $shape : new Shape(),
            'strip' => $strip,
        ]);

        return View::make('strip.clean');
    }

    protected function saveClean($comic_id, $strip_id) {
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
        
        if (Input::get('action') == "saveClean") {
            return Redirect::route('strip.index', [$comic_id]);
        }

        return Redirect::route('strip.import', [$comic_id, $strip_id]);
    }
    
    protected function saveImport($comic_id, $strip_id) {
        if (!Strip::exists($strip_id)) {
            return Redirect::route('home');
        }
        
        return Redirect::route('strip.index', [$comic_id, $strip_id]);
    }
    /**
     * translate strip used by the controller.
     *
     * @return void
     */
    protected function translate($comic_id, $strip_id) {
        $strip = Strip::find($strip_id);
        if ($strip == null) {
            return Redirect::route('home');
        }
        
        $shape = $strip->shapes->first();
        View::share([
            'shape' => $shape != null ? $shape : new Shape(),
            'strip' => $strip,
        ]);

        $shape = $strip->shapes->first();
        View::share([
            'shape' => $shape != null ? $shape : new Shape(),
            'strip' => $strip,
            'fonts' => Font::all()->lists('name', 'name')
        ]);
        return View::make('strip.translate');
    }
    
    protected function saveTranslate($comic_id, $strip_id) {
        if (!Strip::exists($strip_id)) {
            return Redirect::route('home');
        }
        
        return Redirect::route('strip.index', [$comic_id, $strip_id]);
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

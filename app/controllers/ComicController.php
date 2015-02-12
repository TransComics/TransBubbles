<?php

class ComicController extends BaseController {

    public function __construct() {
        $this->beforeFilter('auth', ['except' => ['index']]);
    }
    
    public function index() {
        return View::make('comic.index', [
            'comics' => Comic::paginate(Session::has('paginate') ? Session::get('paginate') : 10)
        ]);
    }

    public function create() {
        $this->prepareForm();
        return View::make('comic.create', [
            'comic' => new Comic()
        ]);
    }

    public function edit($id) {
        $c = Comic::find($id);
        if ($c == null) {
            return Redirect::route('comic.create');
        }
        
        $this->prepareForm();
        return View::make('comic.edit', [
            'comic' => $c
        ]);
    }

    public function store() {
        return $this->checkAndSave(new Comic(), function ($c, $v, $isOk) {
            
            if ($isOk) {
                return Redirect::route('comic.index', [
                    $c->id
                ])->withMessage(Lang::get('comic.added', [
                    'title' => $c->title
                ]));
            }
            return Redirect::route('comic.create')->withInput()
                ->withErrors($v)
                ->withMessage(Lang::get('comic.errorMessage'));
        });
    }

    public function update($id) {
        return $this->checkAndSave(Comic::find($id), function ($c, $v, $isOk) {
            
            if ($isOk) {
                return Redirect::route('comic.update', [
                    $c->id
                ])->withMessage(Lang::get('comic.updated', [
                    'title' => $c->title
                ]));
            }
            
            return Redirect::route('comic.edit', [
                $c->id
            ])->withInput()
                ->withErrors($v)
                ->withMessage(Lang::get('comic.errorMessage'));
        });
    }

    public function destroy($id) {
        $comic = Comic::find($id);
        if ($comic == null) {
            return Redirect::route('home');
        }
        
        Comic::dropFile($comic->cover);
        $comic->delete();
        
        return Redirect::back();
    }

    private function checkAndSave($comic, $return) {
        $v = Validator::make(Input::all(), Comic::rules($comic->id));
        
        $isOk = $v->passes();
        if ($isOk) {
            $comic->title = Input::get('title');
            $comic->author = Input::get('author');
            $comic->description = Input::get('description');
            $comic->authorApproval = Input::get('authorApproval');
            if (Input::hasFile('cover')) {
                Comic::dropFile($comic->cover);
                $comic->cover = Comic::uploadFile(Input::file('cover'));
            }
            $comic->font_id = Input::get('font_id');
            $comic->created_by = Auth::id();
            $comic->save();
        }
        
        return $return($comic, $v, $isOk);
    }

    public function show($id) {
        $comic = Comic::find($id);
        if ($comic == null) {
            return Redirect::route('home');
        }
        
        //TODO remplacer quand y'aura la table strip et les jointures
        $strips = Strip::all();
        //$strips = $comic->strips->whereNotNull('valided_at')->orderBy('valided_at','desc');
        
        return View::make('comic.show', [
            'comic' => $comic,
            'strips' => $strips
        ]);
    }

    private function prepareForm() {
        View::share([
            'fonts' => Font::all()->lists('name', 'id')
        ]);
    }
}

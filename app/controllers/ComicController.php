<?php

class ComicController extends Controller {
	
    public function __construct() {
        $this->beforeFilter('csrf', ['on' => ['post', 'put', 'patch', 'delete']]);
    }
        
    
    public function getAdd() {
        return View::make('comic.add');
    }

    public function putAdd() {
        
        $v = Validator::make(Input::all(), Comic::$rules);
        
        if($v->passes()) {
            $comic = new Comic();
            $comic->title = Input::get('title');
            $comic->page = Input::get('page');
            $comic->save();
            
            return Redirect::route('comic.add')
                ->withMessage(Lang::get('comic.added', [
                    'title' => $comic->title,
                ]));
        }
        
        return Redirect::route('comic.add')
            ->withInput()
            ->withErrors($v)
            ->withMessage(Lang::get('comic.errorMessage'));
    }

}

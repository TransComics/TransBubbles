<?php

class ComicController extends BaseController {
	
    public function addForm() {
        return View::make('comic.update', [
            'fonts' => Font::all(['name'])->keyBy('id'),
            'comic' => new Comic(),
            'isAdd' => true,
        ]);
    }
    
    public function updateForm($id) {
        $c = Comic::find($id);
        if ($c == null) {
            return Redirect::route('comic.add');
        }
        
        return View::make('comic.update', [
            'comic' => $c,
            'isAdd' => false,
        ]);
    }

    public function add() {
        
        return $this->checkAndSave(new Comic(), function($c, $v) {
            
            if ($v->passes()) {
                return Redirect::route('comic.update', [$c->id])
                    ->withMessage(Lang::get('comic.added', [
                        'title' => $c->title,
                    ]));
            }
            return Redirect::route('comic.add')
                ->withInput()
                ->withErrors($v)
                ->withMessage(Lang::get('comic.errorMessage'));
        });
        
    }
    
    public function update($id) {
        
        return $this->checkAndSave(Comic::find($id), function($c, $v) {
            
            if ($v->passes()) {
                return Redirect::route('comic.update', [$c->id])
                    ->withMessage(Lang::get('comic.updated', [
                        'title' => $c->title,
                ]));
            }
        
            return Redirect::route('comic.update', [$c->id])
                ->withInput()
                ->withErrors($v)
                ->withMessage(Lang::get('comic.errorMessage'));

        });
    }
    
    private function checkAndSave($comic, $return) {
        
        $v = Validator::make(Input::all(), Comic::rules());
        
        if($v->passes()) {
            $comic->title = Input::get('title');
            $comic->author = Input::get('author');
            $comic->description = Input::get('description');
            $comic->save();
        }
        
        return $return($comic, $v);
        
    }
    
    public function delete($id) {
        
        Comic::destroy($id);
        return Redirect::back();
        
    }

}

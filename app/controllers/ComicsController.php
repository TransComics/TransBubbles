<?php

class ComicsController extends BaseController {
	
    public function getAdd() {
        return View::make('comics.add');
    }

    public function getList() {
        return View::make('comics.list', [
            'comics' => Comic::paginate(Session::has('paginate')? Session::get('paginate') : 10),
        ]);
    }

}

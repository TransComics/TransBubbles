<?php

class ComicsController extends Controller {
	
    public function getAdd() {
        return View::make('comics.add');
    }

    public function getList() {
        return View::make('comics.list', [
            'comics' => Comic::all(),
        ]);
    }

}

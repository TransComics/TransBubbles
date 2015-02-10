<?php

class LanguageController extends BaseController {
	
    public function select() {
        $lang = Input::get('lang');
        
        Session::put('lang', $lang);
        return Redirect::back();
    }

}

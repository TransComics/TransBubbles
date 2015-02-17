<?php

class LanguageController extends BaseController {
	
    public function select() {
        $lang = Input::get('lang');
        
        Session::put('lang', $lang);
        return Redirect::back();
    }

    public function selectForStrip() {
        $lang = Input::get('lang_id');
        
        Session::put('lang_strip');
        return Redirect::back();
    }
    
}

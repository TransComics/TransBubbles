<?php

class LanguageController extends BaseController {
	
    public function select() {
        $lang = Input::get('lang');
        
        Session::put('lang', $lang);
        return Redirect::back();
    }

    public function selectForStrip() {
        $lang = Input::get('lang_id');
        
        Session::put('lang_strip', Input::get('lang_id'));
        return Redirect::back();
    }
    
    public function selectForStripTo() {
        $lang = Input::get('lang_id');
        
        Session::put('lang_strip_to', Input::get('lang_id'));
        return Redirect::back();
    }
    
}

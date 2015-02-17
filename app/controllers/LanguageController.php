<?php

class LanguageController extends BaseController {
	
    public function select() {
        $lang = Input::get('lang');
        
        Session::put('lang', $lang);
        return Redirect::back();
    }

    public function selectForStrip() {
        $lang = Input::get('lang_strip');
        
        Session::put('lang_strip');
        return Redirect::back();
    }
    
    public function selectForStripTo() {
        $lang = Input::get('lang_strip_to');
        
        Session::put('lang_strip_to');
        return Redirect::back();
    }
    
}

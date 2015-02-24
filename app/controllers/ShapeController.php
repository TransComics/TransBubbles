<?php

class ShapeController extends Controller {  
    public function __construct() {
    }
    
    public function indexModerate($comic_id) {

        
        return View::make('strip.moderate_shape');
    }
    
    public function moderate($comic_id) {
        
    }
}
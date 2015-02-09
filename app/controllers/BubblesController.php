<?php

class BubblesController extends BaseController {

    public function getAll($idStrip, $lang) {
        return "T";
    }

    public function setAll($idStrip, $lang) {     
        return Response::make("", 200);
    }
    
}
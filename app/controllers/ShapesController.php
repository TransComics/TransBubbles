<?php

class ShapesController extends BaseController {

    public function getAllForStrip($id) {
        return $id;
    }

    public function setAllForStrip($id) {
        return Response::make("", 200);
    }
}

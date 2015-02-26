<?php

class HomeController extends BaseController {

    /*
     * |--------------------------------------------------------------------------
     * | Default Home Controller
     * |--------------------------------------------------------------------------
     * |
     * | You may wish to use controllers instead of, or in addition to, Closure
     * | based routes. That's great! Here is an example controller method to
     * | get you started. To route to this controller, just add the route:
     * |
     */
    public function home() {      
        View::share([
        'nb_pending_comics' => Comic::getNbPending()
        ]);
        return View::make('home');
    }
}

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
        
        $strips = Strip::where('validated_state', ValidateEnum::VALIDATED)
            ->where('isShowable', true)
            ->orderBy('validated_at','desc')
//            ->groupBy('comic_id')
            ->take(12)->get();
        
        $comics = Strip::where('validated_state', ValidateEnum::VALIDATED)
            ->where('isShowable', true)
            ->orderBy('validated_at','desc')
            ->groupBy('comic_id')
            ->take(3)->get()
            ->map(function ($c) {
                return $c->comic;
            });
        
        View::share([
            'strips' => $strips,
            'comics' => $comics,
            'nb_pending_comics' => Comic::getNbPending()
        ]);

        return View::make('home');
    }
}

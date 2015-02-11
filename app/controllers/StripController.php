<?php

class StripController extends BaseController {


    /**
     * import strip used by the controller.
     *
     * @return void
     */
    protected function import() {
        return View::make('strip.import');
    }

    /**
     * clean strip used by the controller.
     *
     * @return void
     */
    protected function clean($strip_id) {
        $strip = Strips::find($strip_id);
        if ($strip == null) {
            return Redirect::route('home');
        }

        View::share(['strip' => $strip]);
        
        return View::make('strip.clean');
    }
    
    protected function saveClean($strip_id) {
        $strip = Strips::find($strip_id);
        if ($strip == null) {
            return Redirect::route('home');
        }
        
        $strip->cleanning = Input::get('cleanning');
        $strip->save();
        
        return Redirect::route('strip.clean', [$strip->id]);
    }

    /**
     * translate strip used by the controller.
     *
     * @return void
     */
    protected function translate() {
        return View::make('strip.translate', [
                'fonts' => Font::all()->lists('name', 'name')
        ]);
    }
}

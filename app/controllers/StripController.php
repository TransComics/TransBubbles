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
        
        View::share([
            'shape' => Shape::where('strip_id', '=', $strip->id)->get()->first(),
            'strip' => $strip,
        ]);
        
        return View::make('strip.clean');
    }
    
    protected function saveClean($strip_id) {
        if (!Strips::exists($strip_id)) {
            return Redirect::route('home');
        }
        
        $shape = Shape::find(Input::get('id'));
        if ($shape == null) {
            $shape = new Shape();
        } else if (Auth::check() && $shape->user_id != Auth::user()->id) {
            return Redirect::route('home');
        }
        
        $shape->strip_id = $strip_id;
        $shape->value = Input::get('value');
        if (Auth::check()) {
            $shape->user_id = Auth::user()->id;
        }
        $shape->save();
        
        return Redirect::route('strip.clean', [$strip_id]);
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

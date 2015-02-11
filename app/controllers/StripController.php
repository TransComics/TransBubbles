<?php

class StripController extends BaseController {

    /**
     * import strip used by the controller.
     *
     * @return void
     */
    protected function import()
    {
            return View::make('strip.import');
    }

    /**
     * clean strip used by the controller.
     *
     * @return void
     */
    protected function clean()
    {
            return View::make('strip.clean');
    }

    /**
     * translate strip used by the controller.
     *
     * @return void
     */
    protected function translate()
    {
        return View::make('strip.translate', [
            'fonts' => Font::all()->lists('name', 'name')
        ]);
    }
}
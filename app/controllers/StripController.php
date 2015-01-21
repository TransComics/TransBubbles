<?php

class StripController extends Controller {

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
		return View::make('strip.translate');
	}
}

?>
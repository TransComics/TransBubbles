<?php

namespace Transcomics\GoogleTranslation\Facades;

use Illuminate\Support\Facades\Facade;

class GoogleFacade extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'googleTranslation'; }

}
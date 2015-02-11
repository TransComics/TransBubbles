<?php  
namespace Transcomics\BingTranslation\Facades;

use Illuminate\Support\Facades\Facade;

class BingFacade extends Facade {

/**
* Get the registered name of the component.
*
* @return string
*/
    protected static function getFacadeAccessor() { return 'bingTranslation'; }

}
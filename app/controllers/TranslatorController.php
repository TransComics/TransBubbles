<?php
use Stichoza\Google\GoogleTranslate;

class TranslatorController extends \BaseController {
    
    // RESTFUL
    protected static $restful = true;

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        return View::make('translate.translatetest');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id            
     * @return Response
     */
    public function show($id) {
        $textotranslate = Input::get('text');
        $to = Input::get('to');
        switch ($id) {
            case 'google':
                return $translatedText = GoogleTranslation::translate($textotranslate, 'en', $to);
            case 'bing':
                return $translatedText = BingTranslation::translate($textotranslate, 'en', $to);
            default:
                return Response::json(array(
                    'errorReason' => 'Invalid url api name'
                ));
        }
    }
}

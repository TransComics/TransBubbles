<?php
use Stichoza\Google\GoogleTranslate;

class TranslatorController extends \BaseController {
    
    // RESTFUL
    protected static $restful = true;

    /**
     * Display the specified resource.
     *
     * @param int $id            
     * @return Response
     */
    public function update($id) {
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

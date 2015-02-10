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
                $tr = new GoogleTranslate("en", $to);
                return Response::json(array(
                    'translation' => $tr->translate($textotranslate)
                ));
            case 'bing':
                    \Log::info('controller :');
                  $translatedText = BingTranslation::translate($textotranslate,'en',$to);
                  return Response::json(array(
                      'translation' => $translatedText));
            default:
                return Response::json(array(
                    'errorReason' => 'Invalid url api name'
                ));
        }
    }
}

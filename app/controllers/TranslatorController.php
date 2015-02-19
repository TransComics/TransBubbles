<?php
use Stichoza\Google\GoogleTranslate;

class TranslatorController extends \BaseController {
    
    // RESTFUL
    protected static $restful = true;


    private $duration = 1440;

    /**
     * Display the specified resource.
     *
     * @param int $id            
     * @return Response
     */
    public function update($id) {
        $textotranslate = Input::get('text');
        
        $to = Language::find(Input::get('to'))->shortcode;
        $from = Language::find(Input::get('from'))->shortcode; 
        
        $md5Text = md5($textotranslate);
        $strKey = $id . '_' . $from . '-' . $to . '_' . $md5Text;
        
        $value = $this->checkCache($strKey);
        
        if ($value !== false) {
            return $value;
        } else {
            \Log::info('request');
            switch ($id) {
                case 'google':
                    $translatedText = GoogleTranslation::translate($textotranslate, $from, $to);
                    break;
                case 'bing':
                    $translatedText = BingTranslation::translate($textotranslate, $from, $to);
                    break;
                default:
                    return Response::json(array(
                        'errorReason' => 'Invalid url api name'
                    ));
            }
            
            $this->storeIntoCache($strKey, $translatedText);
            return $translatedText;
        }
    }

    /**
     * Check into cache if translation already done
     *
     * @param String $id            
     * @param String $text            
     * @param String $from            
     * @param String $to            
     *
     * @return false | cached string
     */
    private function checkCache($key) {
        if (Cache::has($key)) {
            return Cache::get($key);
        } else {
            return false;
        }
    }

    private function storeIntoCache($key, $str) {
        return Cache::add($key, $str, $this->duration);
    }
}

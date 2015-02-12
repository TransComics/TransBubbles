<?php
namespace Transcomics\GoogleTranslation;

use Stichoza\Google\GoogleTranslate;

class GoogleTranslation extends \AbstractTranslator {

    public function translate($word, $from, $to) {
        $tr = new GoogleTranslate($from, $to);
        $translation = $tr->translate($word);
        if (! $translation) {
            // An error occured while processing google translate method
            return \Response::json(array(
                'errorReason' => 'An error occured while processing google translate method'
            ));
        }
        return \Response::json(array(
            'translation' => $translation
        ));
    }
}
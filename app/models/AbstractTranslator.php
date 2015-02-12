<?php

abstract class AbstractTranslator {
    // Force les classes filles à définir cette méthode
    abstract protected function translate($word, $from, $to);  
}

?>
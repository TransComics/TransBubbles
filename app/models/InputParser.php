<?php

class InputParser{
    
    private static $pattern= "#<iframe[^>]+>.*?</iframe>#is";
    
    public static function parse($string){
        return preg_replace(self::$pattern, "", $string);
    }
           
    public static function parseAll($string){
        return array_map(array('InputParser', 'parse'), $string);
    }
    
    public static function parseBBCode($string){
        return InputParser::parse(BBCode::parse($string));
    }
    
}
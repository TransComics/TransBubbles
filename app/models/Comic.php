<?php

class Comic extends Eloquent {
    
    public static $rules = [
        'title' => 'required|alpha_num|min:4',
        'page' => 'required|numeric',
    ];
}
<?php

class Comic extends Eloquent {
    
    public static $rules = [
        'title' => 'required|alpha_num|between:4,62',
        'author' => 'required|alpha_num|between:4,62',
        'description' => 'alpha_num',
    ];
    
    protected $guarded = ['id'];

}
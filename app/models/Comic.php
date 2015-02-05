<?php

class Comic extends Eloquent {
    
    protected $guarded = ['id'];
    
    public static function rules() {
        return [
            'title' => 'required|alpha_num|between:4,62',
            'author' => 'required|alpha_num|between:4,62',
            'description' => 'alpha_num',
        ];
    }

}
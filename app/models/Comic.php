<?php

class Comic extends Eloquent {
    
    protected $guarded = ['id'];
    
    public static function rules() {
        return [
            'title' => 'required|between:4,62',
            'author' => 'required|between:4,62',
            'description' => 'max:2000',
            'authorApproval' => 'required|boolean',
            'cover' => 'max:127',
            'font_id' => 'required|numeric'
        ];
    }

}
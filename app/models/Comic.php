<?php

class Comic extends Eloquent {
    
    use UploadFile;
    
    protected $guarded = ['id'];
    
    public static function rules() {
        return [
            'title' => 'required|between:4,63|unique:comics',
            'author' => 'required|between:4,63',
            'description' => 'max:2000',
            'authorApproval' => 'required|boolean',
            'cover' => 'image|mimes:png,jpeg|between:40,4096',
            'font_id' => 'required|numeric'
        ];
    }

}
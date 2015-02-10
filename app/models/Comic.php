<?php

class Comic extends Eloquent {
    
    use UploadFile;
    
    protected $guarded = ['id'];
    
    public static function rules($id = 0) {
        return [
            'title' => 'required|between:4,63|unique:comics,title,'.$id,
            'author' => 'required|between:4,63',
            'description' => 'max:2000',
            'authorApproval' => 'required|boolean',
            'cover' => 'image|mimes:png,jpeg|between:40,4096',
            'font_id' => 'required|numeric'
        ];
    }

}
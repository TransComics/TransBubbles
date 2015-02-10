<?php

class Strips extends Eloquent {

    protected $table = 'strips';
    public $timestamps = true;
    protected $guarded = [ 'id', 'updated_at', 'created_at',
        'insertion_date', 'path'];
    public static $rules = [
        'pageNumber' => 'numeric',
        'strip' => 'required|mimes:jpeg,bmp,png,gif,jpg|max:4096'
    ];
    
    public static $updateRules = [];

}

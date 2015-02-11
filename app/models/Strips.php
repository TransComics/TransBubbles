<?php

class Strips extends Eloquent {

    protected $table = 'strips';
    protected $touches = array('title','cleaning');
    public $timestamps = true;
    protected $guarded = [ 'id', 'updated_at', 'created_at',
        'insertion_date', 'path', 'validated_at'];
    public static $rules = [
        'pageNumber' => 'numeric',
        'title' => 'max:64',
        'strip' => 'required|mimes:jpeg,bmp,png,tiff,tif,jpg|max:4096|image'
    ];
    
    public static $updateRules = [
        'title' => 'max:64'
    ];

}

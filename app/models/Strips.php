<?php

class Strips extends Eloquent {

    protected $table = 'strips';
    public $timestamps = true;
    protected $guarded = [ 'id', 'updated_at', 'created_at',
        'insertion_date', 'path'];
    public static $rules = [
        'pageNumber' => 'numeric',
        'strip' => 'required|mimes:jpeg,bmp,png,gif|max:1024'
    ];

}

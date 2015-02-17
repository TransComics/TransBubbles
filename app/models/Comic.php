<?php

class Comic extends Eloquent {
    
    use UploadFile;
    
    protected $guarded = ['id'];
    
    public function strips () {
        return $this->hasMany('Strip');
    }

}
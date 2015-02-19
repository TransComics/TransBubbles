<?php

class Comic extends Eloquent {
    
    use UploadFile;
    
    protected $guarded = ['id'];
    
    public function strips () {
        return $this->hasMany('Strip');
    }
        
    public function getLastShowable() {
        return $this->strips()->where('isShowable', TRUE)->orderBy('id', 'desc')->first();
    }

}
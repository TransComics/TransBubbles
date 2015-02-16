<?php

class Bubble extends Eloquent {
    
    protected $guarded = ['id'];
    
    public function strip() {
        return $this->belongTo('Strip');
    }
    
    public function user() {
        return $this->belongTo('User');
    }

    public function language() {
        return $this->belongTo('Language', 'lang_id');
    }
    
    public function parent() {
        return $this->belongTo('Bubble', 'parent_id');
    }
    
    public function original() {
        return $this->belongTo('Bubble', 'original_id');
    }

}
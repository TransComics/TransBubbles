<?php

class Bubble extends Eloquent {
    
    protected $guarded = ['id'];
    
    public function strip() {
        return $this->belongsTo('Strip');
    }
    
    public function user() {
        return $this->belongsTo('User');
    }

    public function language() {
        return $this->belongsTo('Language', 'lang_id');
    }
    
    public function parent() {
        return $this->belongsTo('Bubble', 'parent_id');
    }
    
    public function isOriginal() {
        return $this->lang_id == $this->strip->comic->lang_id;
    }

}
<?php

class Shape extends Eloquent {

    protected $guarded = ['id'];

    public function strip() {
        return $this->belongsTo('Strip');
    }
    
    public function user() {
        return $this->belongsTo('User');
    }

}

<?php

class Shape extends Eloquent {

    protected $guarded = ['id'];

    public function strip() {
        return $this->belongsTo('Strip');
    }

}

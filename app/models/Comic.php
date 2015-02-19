<?php

class Comic extends Eloquent implements Moderable {
    
    use UploadFile;

    protected $guarded = [
        'id'
    ];

    public function strips() {
        return $this->hasMany('Strip');
    }

    public function isValidated() {
        return $this->validated_state == 'VALIDATED';
    }

    public function getLastShowable() {
        return $this->strips()
            ->where('isShowable', TRUE)
            ->orderBy('id', 'desc')
            ->first();
    }
}
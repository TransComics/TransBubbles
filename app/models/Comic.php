<?php

class Comic extends Eloquent implements Moderable {
    
    use UploadFile;

    protected $guarded = [
        'id'
    ];
    
    public static $formrRules =  ['title' => 'required|between:4,63|unique:comics',
                'author' => 'required|between:4,63',
                'description' => 'max:2000',
                'authorApproval' => 'accepted|boolean|required',
                'cover' => 'image|mimes:png,jpeg|between:20,4096',
                'font_id' => 'required|numeric',
                'lang_id' => 'required|numeric'];

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
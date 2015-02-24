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
    
    public function user() {
        return $this->hasOne('User');
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
    
    public function getPendingShapes(){
        return $this->strips()->join('shapes', 'strips.id', '=', 'shapes.strip_id')
            ->where('strips.validated_state',ValidateEnum::VALIDATED)
            ->where('shapes.validated_state',ValidateEnum::PENDING);
    }
}
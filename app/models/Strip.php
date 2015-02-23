<?php

class Strip extends Eloquent implements Moderable{

    use UploadFile;

    protected $table = 'strips';
    public $timestamps = true;
    protected $guarded = [ 'id', 'updated_at', 'created_at',
        'insertion_date', 'path', 'validated_at'];
    public static $rules = [
        'pageNumber' => 'numeric',
        'title' => 'max:64|required',
        'strip' => 'required|mimes:jpeg,bmp,png,tiff,tif,jpg|between:20,4096|image'
    ];
    public static $updateRules = [
        'title' => 'max:64|required'
    ];

    public function comic() {
        return $this->belongsTo('Comic');
    }

    public function shapes() {
        return $this->hasMany('Shape');
    }

    public function user() {
        return $this->belongsTo('User');
    }

    public function bubbles() {
        return $this->hasMany('Bubble');
    }

    public function isCleanable() {
        return $this->shapes()->whereNotNull('validated_at')->count() == 0;
    }

    public function isImportable() {
        return $this->shapes()->where(function ($q) {
                $q->whereNotNull('validated_at')->orWhere('user_id', '=', Auth::id());
            })->count() > 0 
                && $this->bubbles()->where('lang_id', $this->comic->lang_id)->whereNotNull('validated_at')->count() == 0;
    }

    public function isTranslateable() {
        return $this->shapes()->where(function ($q) {
                $q->whereNotNull('validated_at')->orWhere('user_id', '=', Auth::id());
            })->count() > 0 
            && $this->bubbles()->where(function ($q) {
                $q->whereNotNull('validated_at')->orWhere('user_id', '=', Auth::id());
            })->count() > 0;
    }

    public function isShowable() {
        return $this->isShowable;
    }
    
    public function isValidated() {
        return $this->validated_state == 'VALIDATED';
    }

}

<?php

class Comic extends Eloquent implements Moderable {
    
    use UploadFile;

    protected $guarded = ['id'];
    protected $fillable = [
        'title',
        'author',
        'authorApproval',
        'font_id',
        'lang_id'
    ];
    
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
        
    public static function getComicToDisplay() {
        return Comic::where(function ($query) {
            $query->where('validated_state', ValidateEnum::VALIDATED)
                ->orWhere('created_by', Auth::check() ? Auth::id() : 0);
        });
    }
    
    public static function getNbPending() {
        return Comic::where('validated_state', ValidateEnum::PENDING)->count();
    }
}
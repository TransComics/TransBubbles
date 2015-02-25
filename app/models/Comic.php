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

    public function stripsValidated($paginate = null) {
        $strips = $this->strips()
            ->where('validated_state', ValidateEnum::VALIDATED);
        
        if (!is_null($paginate)) {
            return $strips->paginate($paginate);
        }
        return $strips;
    }
    
    public function stripsShowable($paginate = null) {
        $strips = $this->strips()
            ->where('validated_state', ValidateEnum::VALIDATED)
            ->where('isShowable', true)
            ->orderBy('validated_at', 'desc');
        
        if (!is_null($paginate)) {
            return $strips->paginate($paginate);
        }
        return $strips;
    }
    
    public function getFirstShowable() {
        return $this->strips()
            ->where('isShowable', true)
            ->orderBy('index')
            ->first();
    }
    
    public function getLastShowable() {
        return $this->strips()
            ->where('isShowable', true)
            ->orderBy('index', 'desc')
            ->first();
    }

    public function getPendingShapes(){
        return $this->strips()->join('shapes', 'strips.id', '=', 'shapes.strip_id')
            ->where('strips.validated_state',ValidateEnum::VALIDATED)
            ->where('shapes.validated_state',ValidateEnum::PENDING)
            ->orderBy('shapes.id');
    }

    public function getPendingImport(){
            return $this->strips()->join('bubbles', 'strips.id', '=', 'bubbles.strip_id')
            ->where('strips.validated_state',ValidateEnum::VALIDATED)
            ->where('bubbles.validated_state',ValidateEnum::PENDING)
            ->where('bubbles.lang_id',$this->lang_id)
            ->orderBy('bubbles.id');
     }
     
     public function getPendingBubbles(){
         return $this->strips()->join('bubbles', 'strips.id', '=', 'bubbles.strip_id')
         ->where('strips.validated_state',ValidateEnum::VALIDATED)
         ->where('bubbles.validated_state',ValidateEnum::PENDING)
         ->where('bubbles.lang_id','<>',$this->lang_id)
         ->orderBy('bubbles.id');
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

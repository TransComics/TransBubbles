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
    
    public function getBestBubbles($lang_id, $user_id) {
        
        $bubbles = $this->bubbles()
            ->where('validated_state', ValidateEnum::VALIDATED)
            ->where('lang_id', $lang_id)
            ->first();
        
        if ($bubbles !== null) {
            return $bubbles;
        }
        
        return $this->bubbles()
            ->where('validated_state', '<>', ValidateEnum::VALIDATED)
            ->where('user_id', '=', $user_id)
            ->where('lang_id', $lang_id)
            ->first();
    }

    public function getBubblesToEdit($lang_id, $user_id) {
        return $this->bubbles()
            ->where('validated_state', '<>', ValidateEnum::VALIDATED)
            ->where('user_id', '=', $user_id)
            ->where('lang_id', '=', $lang_id)
            ->first();
        
    }
    
    public function getBestShapes($user_id) {
        return $this->shapes()
            ->where(function($query) use ($user_id) {
                $query
                    ->where('validated_state', ValidateEnum::VALIDATED)
                    ->orWhere('user_id', '=', $user_id);
            })
            ->first();
    }
    
    public function getLanguagesWithTranslate($user_id = null) {
        return DB::table('languages')
            ->join('bubbles', 'bubbles.lang_id', '=', 'languages.id')
            ->where('bubbles.strip_id', '=', $this->id)
            ->where(function ($query) use ($user_id) {
                $query
                    ->where('bubbles.validated_state', ValidateEnum::VALIDATED)
                    ->orWhere(function ($query) use ($user_id) {
                        $query->where('lang_id', '=', $this->comic->lang_id);
                        if (!is_null($user_id)) {
                            $query->where('user_id', '=', $user_id);
                        }
                    });
            })
            ->select('languages.id', 'languages.label');
    }
    
    public function getLanguagesToTranslate() {
        return DB::table('languages')
            ->where('languages.id', '<>', $this->comic->lang_id)    ;
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
    
    public function updateShowable() {
        $this->isShowable = DB::table('strips')
            ->join('shapes', 'shapes.strip_id', '=', 'strips.id')
            ->join('bubbles', 'bubbles.strip_id', '=', 'strips.id')
            ->where('shapes.validated_state', ValidateEnum::VALIDATED)
            ->where('bubbles.validated_state', ValidateEnum::VALIDATED)
            ->where('strips.validated_state', ValidateEnum::VALIDATED)
            ->where('strips.id',$this->id)
            ->groupBy('strips.id')
            ->count() > 1;
        
        $this->save();
    }
    
    public function isValidated() {
        return $this->validated_state == 'VALIDATED';
    }
    
    public function getPreviousShowable() {
        return $this->comic->strips()
            ->where('isShowable', true)
            ->where('id', '<', $this->id)
            ->orderBy('id', 'desc')
            ->first();
    }
    
    public function getAnotherShowable() {
        return $this->comic->strips()
            ->where('isShowable', true)
            ->where('id', '<>', $this->id)
            ->orderByRaw('RAND()')
            ->first();
    }
    
    public function getNextShowable() {
        return $this->comic->strips()
            ->where('isShowable', true)
            ->where('id', '>', $this->id)
            ->orderBy('id')
            ->first();
    }
}

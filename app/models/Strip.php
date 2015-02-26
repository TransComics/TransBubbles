<?php

class Strip extends Eloquent implements Moderable {

    use UploadFile;

    protected $table = 'strips';
    public $timestamps = true;
    protected $guarded = [ 'id', 'updated_at', 'created_at',
        'insertion_date', 'path', 'validated_at'];
    public static $rules = [
        'pageNumber' => 'numeric',
        'title' => 'max:64|required',
        'strip' => 'required|max:1024|image',
        'index' => 'integer|required|min:0'
    ];
    public static $updateRules = [
        'title' => 'max:64|required',
        'index' => 'integer|required|min:0'
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
            ->leftJoin('votes', 'votes.bubble_id', '=', 'bubbles.id')
            ->where('validated_state', ValidateEnum::VALIDATED)
            ->where('bubbles.lang_id', $lang_id)
            ->groupBy('bubbles.id')
            ->select(DB::raw('`bubbles`.`id` as id, `bubbles`.`user_id`, `bubbles`.`strip_id`, `bubbles`.`lang_id`, `bubbles`.`value`, COUNT(`bubbles`.`id`) as votes'))
            ->orderBy('votes', 'desc')
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
    
    public function getBestShapes($user_id = null) {
        return $this->shapes()
            ->where(function($query) use ($user_id) {
                $query->where('validated_state', ValidateEnum::VALIDATED);
                if (!is_null($user_id)) {
                    $query->orWhere('user_id', '=', $user_id);
                }
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
        return $this->shapes()->where('validated_state', ValidateEnum::VALIDATED)->count() == 0;
    }

    public function isImportable() {
        return $this->shapes()->where(function ($q) {
                    $q->where('validated_state', ValidateEnum::VALIDATED)->orWhere('user_id', '=', Auth::id());
                })->count() > 0 && $this->bubbles()->where('lang_id', $this->comic->lang_id)->where('validated_state', ValidateEnum::VALIDATED)->count() == 0;
    }

    public function isTranslateable() {
        return $this->shapes()->where(function ($q) {
                    $q->where('validated_state', ValidateEnum::VALIDATED)->orWhere('user_id', '=', Auth::id());
                })->count() > 0 && $this->bubbles()->where(function ($q) {
                    $q->where('validated_state', ValidateEnum::VALIDATED)->orWhere('user_id', '=', Auth::id());
                })->count() > 0;
    }

    public function isShowable() {
        return $this->isShowable;
    }
    
    public function updateShowable() {
        $this->isShowable = DB::table('strips')
            ->join('shapes', 'shapes.strip_id', '=', 'strips.id')
            ->join('bubbles', 'bubbles.strip_id', '=', 'strips.id')
            ->join('comics', 'comics.id', '=', 'strips.comic_id')
            ->where('shapes.validated_state', ValidateEnum::VALIDATED)
            ->where('comics.validated_state', ValidateEnum::VALIDATED)
            ->where('bubbles.validated_state', ValidateEnum::VALIDATED)
            ->where('strips.validated_state', ValidateEnum::VALIDATED)
            ->where('strips.id',$this->id)
            ->groupBy('strips.id')
            ->count() > 0;
        
        $this->save();
    }
    
    public function isValidated() {
        return $this->validated_state == 'VALIDATED';
    }
    
    public function getPreviousShowable() {
        return $this->comic->strips()
            ->where('isShowable', true)
            ->where('index', '<', $this->index)
            ->orderBy('index', 'desc')
            ->first();
    }
    
    public function getAnotherShowable() {
        return $this->comic->strips()
            ->where('isShowable', true)
            ->where('index', '<>', $this->index)
            ->orderByRaw('RAND()')
            ->first();
    }
    
    public function getNextShowable() {
        return $this->comic->strips()
            ->where('isShowable', true)
            ->where('index', '>', $this->index)
            ->orderBy('index')
            ->first();
    }

    /**
     * Check if there is a strip at this index
     * @param type $index
     * @return boolean True if ok, false othewise
     */
    public static function prepareStripIndex($index, $comic_id) {
        $strip = Strip::where('index', $index)
                ->where('comic_id', $comic_id)
                ->first();
        
        if ($strip == null) {
            // Ok, nothing at this index
            return true;
        }
        
        return Strip::incrementIndex($strip, $comic_id);
    }

    /**
     * Move every strip to the next index until a gap is found
     * @param Strip $strip Object to increment index
     * @param Integer $comic_id Id of the comic whoose we are creating the strip on
     */
    private static function incrementIndex($strip, $comic_id) {
                
        $strips =  Strip::where('index', '>=' ,$strip->index)
                ->where('comic_id', $comic_id)
                ->get();
                
        // We found the last continuous index
        $lastContinuousIndex = 0;
        while($lastContinuousIndex+1 != $strips->count() && $strips[$lastContinuousIndex+1]->index == $strips[$lastContinuousIndex]->index+1) {
            $lastContinuousIndex++;
        }
        
        // We increment everyone from continuous index to new strip index
        for($i = $lastContinuousIndex; $i >= 0; $i--) {
            $strips[$i]->index++;
            $strips[$i]->save();
        }
    }

}

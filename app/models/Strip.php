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
        'strip' => 'required|mimes:jpeg,bmp,png,tiff,tif,jpg|between:20,4096|image',
        'index' => 'integer|required'
    ];
    public static $updateRules = [
        'title' => 'max:64|required',
        'index' => 'integer|required'
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
                })->count() > 0 && $this->bubbles()->where('lang_id', $this->comic->lang_id)->whereNotNull('validated_at')->count() == 0;
    }

    public function isTranslateable() {
        return $this->shapes()->where(function ($q) {
                    $q->whereNotNull('validated_at')->orWhere('user_id', '=', Auth::id());
                })->count() > 0 && $this->bubbles()->where(function ($q) {
                    $q->whereNotNull('validated_at')->orWhere('user_id', '=', Auth::id());
                })->count() > 0;
    }

    public function isShowable() {
        return $this->isShowable;
    }

    public function isValidated() {
        return $this->validated_state == 'VALIDATED';
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
     * @return boolean True if everything is ok, false otherwise
     */
    private static function incrementIndex($strip, $comic_id) {
        if ($strip == null) {
            return true;
        }
        
        $nextIndex = $strip->index;
        $nextIndex++;

        $nextStrip = Strip::where('index', $nextIndex)
                ->where('comic_id', $comic_id)
                ->first();
        
        if (!Strip::incrementIndex($nextStrip, $comic_id)) {
            // Trouble somewhere :O
            return false;
        }

        // We increment and persist
        $strip->index++;
        $strip->save();

        return true;
    }

}

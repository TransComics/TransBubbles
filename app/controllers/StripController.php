<?php

use Transcomics\RoleRessource\RessourceDefinition;

class StripController extends BaseController {

    public function __construct() {
        $this->beforeFilter('auth', ['except' => ['index', 'show']]);
        $this->beforeFilter('access', ['only' => ['show', 'edit', 'update', 'destroy']]);
    }

    /**
     * show strip used by the controller.
     *
     * @return void
     */
    protected function show($comic_id, $id) {
        $comic = Comic::find($comic_id);
        if ($comic == null) {
            return Redirect::route('access.denied');
        }

        $strip = $comic->strips->find($id);
        if ($strip == null) {
            return Redirect::route('access.denied');
        }
        
        $popularity = Popularities::where('strip_id',$id)->first();
        
        if (!$strip->isShowable()) {
            return Redirect::route('access.denied');
        }

        $lang_strip = Session::has('lang_strip') ? Session::get('lang_strip') : $comic->lang_id;
        $shapes = $strip->shapes()->where('validated_state', ValidateEnum::VALIDATED)->first();
        $bubbles = $strip->bubbles()->where('validated_state', ValidateEnum::VALIDATED)->where('lang_id', '=', $lang_strip)->first();
        if ($bubbles === null) {
            $bubbles = $strip->bubbles()->where('validated_state', ValidateEnum::VALIDATED)->where('lang_id', '=', $comic->lang_id)->first();
        }

        $available_languages = DB::table('languages')
                ->join('bubbles', 'bubbles.lang_id', '=', 'languages.id')
                ->where('bubbles.strip_id', '=', $strip->id)
                ->where('bubbles.validated_state', ValidateEnum::VALIDATED)
                ->select('languages.id', 'languages.label')
                ->lists('label', 'id');

        View::share([
            /* Paginate. */
            'first_strip' => $comic->getFirstShowable(),
            'previous_strip' => $strip->getPreviousShowable(),
            'random_strip' => $strip->getAnotherShowable(),
            'next_strip' => $strip->getNextShowable(),
            'last_strip' => $comic->getLastShowable(),
            'available_languages' => $available_languages,
            'lang_strip' => $lang_strip,
            'bubble_id' => $bubbles->id,
            'canvas' => $this->mergeShapesAndBubblesJSON($shapes, $bubbles),
            'canvas_height' => $this->getHeight($shapes->value),
            'canvas_width' => $this->getWidth($shapes->value)
        ]);

        return View::make('strip.show', [
                'strips' => $strip,
                'popularity' => $popularity
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($comic_id) {

        $comic = Comic::find($comic_id);
        if ($comic == null || $comic->strips->count() < 1) {
            return Redirect::route('comic.index');
        }

        $paginate = Session::has('paginate') ? Session::get('paginate') : 12;

        if (RoleRessource::isAllowed('M', RessourceDefinition::Comics, $comic_id, Auth::id())) {
            $strips = $comic->strips()->paginate($paginate);
        } else {
            $strips = $comic->stripsValidated($paginate);
        }
        
        /**
         * Getting pending strip and count
         */
        $stripsPending = $comic->getPendingStrips();
        $nb_pending = $stripsPending->count();
        if($nb_pending){
            $strip_id = $stripsPending->first()->id;
        }else {
            $strip_id = '';
        }
        
        /**
         * Getting pending shapes and count
         */
        $shapes = $comic->getPendingShapes(); 
        $nb_pending_shape = $shapes->count();
        if($nb_pending_shape){
            $shape_id = $shapes->first()->id;
        }else {
            $shape_id = '';
        }
        
        /**
         * Getting pending import and count
         */ 
        $imports = $comic->getPendingImport();
        $nb_pending_import = $imports->count();
 
        if($nb_pending_import){
            $import_id = $imports->first()->id;
        }else {
            $import_id = '';
        }
        
        /**
         * Getting pending bubbles and count
         */
        $bubbles = $comic->getPendingBubbles();
        $nb_pending_bubble = $bubbles->count();
        
        if($nb_pending_bubble){
            $bubble_id = $bubbles->first()->id;
        }else {
            $bubble_id = '';
        }


        View::share([
            'comic' => $comic,
            'nb_pending' => $nb_pending,
            'nb_pending_shape' => $nb_pending_shape,
            'nb_pending_import' => $nb_pending_import,
            'nb_pending_bubble' => $nb_pending_bubble,
            'shape_id' => $shape_id,
            'import_id' => $import_id,
            'bubble_id' => $bubble_id,
            'strip_id' => $strip_id,
            'strips' => $strips
        ]);
        
        return View::make('strip.index');
    }

    public function edit($comic_id, $id) {

        $comic = Comic::find($comic_id);
        if ($comic == null) {
            return Redirect::route('comic.index');
        }

        $strip = $comic->strips->find($id);
        if ($strip == null) {
            return Redirect::route('comic.index');
        }

        Form::setValidation(Strip::$rules);
        return View::make('strip.edit', [
                    'strips' => $strip
        ]);
    }

    public function create($comic_id) {
        Form::setValidation(Strip::$rules);
        return View::make('strip.create', [
                    'strips' => new Strip(),
                    'comic_id' => $comic_id
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id            
     * @return Response
     */
    public function update($comic_id, $id) {
        $valid = Validator::make([
                    'title' => Input::get('title')
                        ], Strip::$updateRules);

        $comic = Comic::find($comic_id);
        if ($comic == null) {
            return Redirect::route('comic.index');
        }

        $strip = $comic->strips->find($id);
        if ($strip == null) {
            return Redirect::route('comic.index');
        }

        if ($valid->passes()) {
            $strip->title = Input::get('title');
            $strip->validated_state = ValidateEnum::PENDING;
            $strip->save();
        } else {
            return Redirect::back()->with('message', Lang::get('strips.updateFailure'))
                            ->withErrors($valid)
                            ->withInput();
        }
        return Redirect::back()->with('message', Lang::get('strips.editComplete'));
    }

    /**
     * Add a newly created resource in storage.
     *
     * @param Request $comic_id            
     * @return Response
     */
    public function store($comic_id) {

        $titles = Input::get('titles');
        $files = Input::file('files');
        foreach ($files as $key => $file) {
            $valid = Validator::make([
                    'strip' => $file,
                    'title' => $titles[$key]
                    ], Strip::$rules);
            if ($valid->fails()) {
                return Redirect::back()->withErrors($valid);
            } else {
                $fileLocation = UploadFile::uploadFile($file);

                $strip = new Strip();
                $strip->title = $titles[$key];
                $strip->path = $fileLocation;
                $strip->validated_at = NULL;
                $strip->comic_id = $comic_id;
                $strip->user_id = Auth::id();
                $strip->save();
                RoleRessource::addRight(2, RessourceDefinition::Strips, $strip->id, Auth::id());

                Queue::push('OcrImport', [
                    'img_url' => $strip->path,
                    'strip_id' => $strip->id,
                    'lang_id' => $strip->comic->lang_id,
                    'user_id' => Auth::id()
                ]);
                
                //add an entry in the popularities table
                $popularity = new Popularities();
                $popularity->strip_id = $strip_id; 
                $popularity->save();
            }
        }
        return Redirect::route('strip.index', ['comic_id' => $comic_id])->with('message', Lang::get('strip.uploadComplete'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id            
     * @return Response
     */
    public function destroy($comic_id, $id) {
        $strip = Strip::find($id);
        if ($strip == null) {
            return Redirect::route('comic.index');
        }
        UploadFile::dropFile($strip->path);
        $strip->delete();
        
        $popularity=Popularities::where('strip_id',$id)->first();
        if ($popularity != null) {
            $popularity->delete();
        }
        else{
            Log::error("Popularity not found");
        }
        $this->removeRightOnStrip($id, $strip->user_id);

        return Redirect::back()->with('message', Lang::get('strips.deleteSucceded'));
    }

    public function indexModerate($comic_id, $strip_id) {
        $comic = Comic::find($comic_id);
        if ($comic == null) {
            return Redirect::route('strip.index');
        }
        
        $strip = Strip::find($strip_id);
        if(empty($strip)){
            return Redirect::route('strip.index', $comic_id);
        }
      
        $nextPendingStrip = $comic->getPendingStrips()->where('strips.id', '>', $strip_id)->orderBy('strips.id')->first();
        $previousPendingStrip = $comic->getPendingStrips()->where('strips.id', '<', $strip_id)->orderBy('strips.id')->first();
        
        View::share([
        'strip' => $strip,
        'nextPendingStrip' => $nextPendingStrip,
        'previousPendingStrip' => $previousPendingStrip
        ]);
         
        return View::make('strip.moderate');
    }

    public function moderate($comic_id, $strip_id) {
        $comic = Comic::find($comic_id);
        if ($comic == null) {
            return Redirect::route('strip.index', $comic_id);
        }

        $strip_id = Input::get('strip_id');
        $choice = Input::get('choice');


        $strip = $comic->strips->find($strip_id);
        if ($strip == null) {
            return Redirect::route('strip.index', $comic_id);
        }

        $strip->validated_by = Auth::id();
        $strip->validated_at = new DateTime();
        switch ($choice) {
            case 'accept':
                $strip->validated_state = ValidateEnum::VALIDATED;
                $strip->save();
                $this->removeRightOnStrip($strip_id, $strip->user_id);
                $strip->updateShowable();
                break;
            case 'refuse':
                $comment = Input::get('comment');
                if (empty($comment)) {
                    return Redirect::route('strip.moderate')->withcomic($strip)->withMessage(Lang::get('moderate.missing_comment'));
                }

                $strip->validated_state = ValidateEnum::REFUSED;
                $strip->validated_comments = $comment;
                $strip->save();

                if (Input::has('delete')) {
                    UploadFile::dropFile($strip->path);
                    $strip->delete();
                }
                break;
            default:
                throw new InvalidArgumentException();
        }
        
        $stripsPending = $comic->getPendingStrips();
        $nb_pending = $stripsPending->count();
        if($nb_pending){
            $strip_id = $stripsPending->first()->id;
            return Redirect::route('strip.moderate',[$comic_id, $strip_id]);
        }else {
            return Redirect::route('strip.index',$comic_id);
        } 
    }

    private function removeRightOnStrip($strip_id, $user_id) {

        $role_ressource = RoleRessource::where('ressource', RessourceDefinition::Strips)
                ->where('ressource_id', $strip_id)
                ->where('user_id', $user_id)
                ->first();

        if (empty($role_ressource)) {
            Log::error('Error when removing right of user $user_id on the strip $strip_id after moderation');
        } else {
            $role_ressource->delete();
        }
    }
    
    public function indexModerateShape($comic_id, $shape_id) {
        $comic = Comic::find($comic_id);
        if($comic == null) {
            return Redirect::route('access.denied');
        }      
        $shape = Shape::find($shape_id);
        if(empty($shape)){
            return Redirect::route('strip.index', $comic_id);
        }
        
        $nextPendingShape = $comic->getPendingShapes()->where('shapes.id', '>', $shape_id)->orderBy('shapes.id')->first();
        $previousPendingShape = $comic->getPendingShapes()->where('shapes.id', '<', $shape_id)->orderBy('shapes.id')->first();
    
        View::share([
            'shape' => $shape,
            'strip' => $shape->strip,
            'canvas' => $shape->value,
            'canvas_height' => $this->getHeight($shape->value),
            'canvas_width' => $this->getWidth($shape->value),
            'nextPendingShape' => $nextPendingShape,
            'previousPendingShape' => $previousPendingShape
        ]);
    
        return View::make('strip.moderate_shape');
    }
    
    public function moderateShape($comic_id, $shape_id) {
        $comic = Comic::find($comic_id);
        if ($comic == null) {
            return Redirect::route('comic.index');
        }
            
        $shape = Shape::find($shape_id);
        if ($shape == null) {
            return Redirect::route('strip.index',$comic_id);
        }
        $strip_id = Input::get('strip_id');
        $choice = Input::get('choice');
         
        $strip = $comic->strips->find($strip_id);
        if ($strip == null) {
            return Redirect::route('strip.index', $comic_id);
        }
        
        $shape->validated_by = Auth::id();
        $shape->validated_at = new DateTime();
        switch ($choice) {
            case 'accept':      
                $shape->validated_state = ValidateEnum::VALIDATED;
                $shape->save();
                //Once a shape has been accepted, we delete others shape with this id
                $shapeToDelete = Shape::where('strip_id',$strip_id)
                                        ->where('validated_state','<>',ValidateEnum::VALIDATED)->delete();
                $strip->updateShowable();
                break;
            case 'refuse':   
                $comment = Input::get('comment');
                if (empty($comment)) {
                    return Redirect::route('strip.moderateShape',$comic_id,$shape_id)->withMessage(Lang::get('moderate.missing_comment'));
                }
                $shape->validated_state = ValidateEnum::REFUSED;
                $shape->validated_comments = $comment;
                $shape->save();
                break;
            default:
                throw new InvalidArgumentException();
        }
        $shapes = $comic->getPendingShapes();
        $nb_pending_shape = $shapes->count();
    
        if($nb_pending_shape){
            $shape_id = $shapes->first()->id;
            return Redirect::route('strip.moderateShape',[$comic_id, $shape_id]);
        }else{
            return Redirect::route('strip.index',$comic_id);
        }
    }
    
    public function indexModerateImport($comic_id, $import_id) {
        $comic = Comic::find($comic_id);
        if($comic == null) {
            return Redirect::route('access.denied');
        }
        $bubble = Bubble::find($import_id);
        if(empty($bubble)){
            return Redirect::route('strip.index', $comic_id);
        }
        $strip = $bubble->strip;
        //$shape = $strip->shapes()->where('validated_state', ValidateEnum::VALIDATED)->first();
        $shape = $strip->shapes()->where(function ($q) {
            $q->where('validated_state', ValidateEnum::VALIDATED)->orWhere('user_id', Auth::id());
        })->first();
        
        
        $nextPendingImport = $comic->getPendingImport()->where('bubbles.id', '>', $import_id)->orderBy('bubbles.id')->first();
        $previousPendingImport = $comic->getPendingImport()->where('bubbles.id', '<', $import_id)->orderBy('bubbles.id')->first();
 
        View::share([
        'strip' => $strip,
        'canvas' => $this->mergeShapesAndBubblesJSON($shape, $bubble),
        'canvas_height' => $this->getHeight($shape->value),
        'canvas_width' => $this->getWidth($shape->value),
        'bubble' => $bubble,
        'nextPendingImport' => $nextPendingImport,
        'previousPendingImport' => $previousPendingImport
        ]);
               
        return View::make('strip.moderate_import');
    }
    
    public function moderateImport($comic_id, $import_id) {
        $comic = Comic::find($comic_id);
        if($comic == null) {
            return Redirect::route('access.denied');
        }
        $bubble = Bubble::find($import_id);
        if(empty($bubble)){
            return Redirect::route('strip.index', $comic_id);
        }
        
        $strip_id = Input::get('strip_id');
        $choice = Input::get('choice');
        
        $strip = $comic->strips->find($strip_id);
        if ($strip == null) {
            return Redirect::route('strip.index', $comic_id);
        }
        
        $bubble->validated_by = Auth::id();
        $bubble->validated_at = new DateTime();
        switch ($choice) {
            case 'accept':
                $bubble->validated_state = ValidateEnum::VALIDATED;
                $bubble->save();
                //Once a bubble import has been accepted, we delete others bubble with this strip id
                $bubbleToDelete = Bubble::where('strip_id',$strip_id)
                                        ->where('lang_id', $comic->lang_id)
                                        ->where('validated_state','<>',ValidateEnum::VALIDATED)
                                        ->delete();
                $strip->updateShowable();
                break;
            case 'refuse':
                $comment = Input::get('comment');
                if (empty($comment)) {
                    return Redirect::route('strip.moderateImport',$comic_id,$import_id)->withMessage(Lang::get('moderate.missing_comment'));
                }
                $bubble->validated_state = ValidateEnum::REFUSED;
                $bubble->validated_comments = $comment;
                $bubble->save();
                break;
            default:
                throw new InvalidArgumentException();
        }
        
        $imports = $comic->getPendingImport();
        $nb_pending_import = $imports->count();
        
        if($nb_pending_import){
            $import_id = $imports->first()->id;
            return Redirect::route('strip.moderateImport',[$comic_id, $import_id]);
        }else{
            return Redirect::route('strip.index',$comic_id);
        }  
    }
    
    public function indexModerateBubble($comic_id, $bubble_id) {
        $comic = Comic::find($comic_id);
        if($comic == null) {
            return Redirect::route('access.denied');
        }
        $bubble = Bubble::find($bubble_id);
        if(empty($bubble)){
            return Redirect::route('strip.index', $comic_id);
        }
        $strip = $bubble->strip;
        //$shape = $strip->shapes()->where('validated_state', ValidateEnum::VALIDATED)->first();
        $shape = $strip->shapes()->where(function ($q) {
            $q->where('validated_state', ValidateEnum::VALIDATED)->orWhere('user_id', Auth::id());
        })->first();
        
        
        $nextPendingBubble = $comic->getPendingBubbles()->where('bubbles.id', '>', $bubble_id)->orderBy('bubbles.id')->first();
        $previousPendingBubble = $comic->getPendingBubbles()->where('bubbles.id', '<', $bubble_id)->orderBy('bubbles.id')->first();
        
        $available_languages = $strip->getLanguagesWithTranslate($strip->user_id)->lists('label', 'id');
        $lang_strip = Session::has('lang_strip') ? Session::get('lang_strip') : $strip->comic->lang_id;
        $original_bubbles =  $strip->getBestBubbles($lang_strip,$strip->user_id);
        
        View::share([
        'strip' => $strip,
        'canvas_origin' => $this->mergeShapesAndBubblesJSON($shape, $original_bubbles), 
        'canvas' => $this->mergeShapesAndBubblesJSON($shape, $bubble),
        'canvas_height' => $this->getHeight($shape->value),
        'canvas_width' => $this->getWidth($shape->value),
        'bubble' => $bubble,
        'nextPendingBubble' => $nextPendingBubble,
        'previousPendingBubble' => $previousPendingBubble,
        'available_languages' => $available_languages,
        'lang_strip' => $lang_strip
        ]);
         
        return View::make('strip.moderate_bubble');
    }
    
    public function moderateBubble($comic_id, $bubble_id) {
    $comic = Comic::find($comic_id);
        if($comic == null) {
            return Redirect::route('access.denied');
        }
        $bubble = Bubble::find($bubble_id);
        if(empty($bubble)){
            return Redirect::route('strip.index', $comic_id);
        }
        
        $strip_id = Input::get('strip_id');
        $choice = Input::get('choice');
        
        $strip = $comic->strips->find($strip_id);
        if ($strip == null) {
            return Redirect::route('strip.index', $comic_id);
        }
        
        $bubble->validated_by = Auth::id();
        $bubble->validated_at = new DateTime();
        switch ($choice) {
            case 'accept':
                $bubble->validated_state = ValidateEnum::VALIDATED;
                $bubble->save();
                $strip->updateShowable();
                break;
            case 'refuse':
                $comment = Input::get('comment');
                if (empty($comment)) {
                    return Redirect::route('strip.moderateBubble',$comic_id,$bubble_id)->withMessage(Lang::get('moderate.missing_comment'));
                }
                $bubble->validated_state = ValidateEnum::REFUSED;
                $bubble->validated_comments = $comment;
                $bubble->save();
                break;
            default:
                throw new InvalidArgumentException();
        }
        
        $bubbles = $comic->getPendingBubbles();
        $nb_pending_bubble = $bubbles->count();
        
        if($nb_pending_bubble){
            $bubble_id = $bubbles->first()->id;
            return Redirect::route('strip.moderateBubble',[$comic_id, $bubble_id]);
        }else{
            return Redirect::route('strip.index',$comic_id);
        }
    }
    

    /**
     * clean strip used by the controller.
     *
     * @return void
     */
    protected function clean($comic_id, $strip_id) {
        $strip = Strip::find($strip_id);
        if ($strip === null || !$strip->isCleanable()) {
            return Redirect::route('access.denied');
        }

        $shape = $strip->shapes()
                ->where('user_id', '=', Auth::id())
                ->first();

        View::share([
            'shape' => $shape != null ? $shape : new Shape(),
            'strip' => $strip,
            'canvas_delivered' => $shape != null ? $shape->value : ''
        ]);

        return View::make('strip.clean');
    }

    protected function saveClean($comic_id, $strip_id) {
        $strip = Strip::find($strip_id);
        if ($strip === null || !$strip->isCleanable()) {
            return Redirect::route('access.denied');
        }

        $shape = $strip->shapes()
                ->where('user_id', Auth::user()->id)
                ->first();

        if ($shape == null) {
            $shape = new Shape();
        }

        $shape->strip_id = $strip_id;
        $shape->value = Input::get('value');
        $shape->user_id = Auth::user()->id;
        $shape->save();

        if (Input::get('action') == "saveClean") {
            return Redirect::route('strip.index', [
                        $comic_id
            ]);
        }

        return Redirect::route('strip.import', [
                    $comic_id,
                    $strip_id
        ]);
    }

    /**
     * import strip used by the controller.
     *
     * @return void
     */
    protected function import($comic_id, $strip_id) {
        $strip = Strip::find($strip_id);
        if ($strip === null || !$strip->isImportable()) {
            return Redirect::route('access.denied');
        }
        $shape = $strip->shapes()->where(function ($q) {
                    $q->where('validated_state', ValidateEnum::VALIDATED)->orWhere('user_id', Auth::user()->id);
                })->first();
        $bubble = $strip->bubbles()
        	->where('user_id', Auth::user()->id)
            ->where('lang_id', '=', $strip->comic->lang_id)
            ->first();
                
        View::share([
            'fonts' => Font::all()->lists('name', 'name'),
            'font_id' => Font::find($strip->comic->font_id)->name,
            'strip' => $strip,
            'canvas_delivered' => $this->mergeShapesAndBubblesJSON($shape, $bubble),
            'bubble' => $bubble != null ? $bubble : new Bubble()
        ]);

        return View::make('strip.import');
    }

    protected function saveImport($comic_id, $strip_id) {
        $strip = Strip::find($strip_id);
        if ($strip === null || !$strip->isImportable()) {
            return Redirect::route('access.denied');
        }

        $bubble = Bubble::find(Input::get('id'));
        if ($bubble == null) {
            $bubble = new Bubble();
        } else
        if ($bubble->user->id != Auth::id()) {
            return Redirect::route('access.denied');
        }

        if ($bubble->validated_at != null) {
            return Redirect::route('access.denied');
        }

        $bubble->lang_id = $strip->comic->lang_id;
        $bubble->strip_id = $strip_id;
        $bubble->value = $this->extractTextsFromJSON(Input::get('value'));
        $bubble->user_id = Auth::id();
        $bubble->save();

        return Redirect::route('strip.index', [
                    $comic_id
        ]);
    }

    /**
     * translate strip used by the controller.
     *
     * @return void
     */
    protected function translate($comic_id, $strip_id) {
        $strip = Strip::find($strip_id);
        if ($strip === null || !$strip->isTranslateable()) {
            return Redirect::route('access.denied');
        }
        $shapes = $strip->shapes()->where(function($q) {
                    $q->whereNotNull('validated_at')->orWhere('user_id', '=', Auth::id());
                })->first();

        $original_bubbles = $strip->bubbles()
                ->whereNotNull('validated_at')
                ->where('lang_id', '=', Session::has('lang_strip') ? Session::get('lang_strip') : $strip->comic->lang_id)
                ->first();
        if ($original_bubbles === null) {
            $original_bubbles = $strip->bubbles()
                    ->whereNull('validated_at')
                    ->where('user_id', '=', Auth::id())
                    ->first();
        }
        if ($original_bubbles === null) {
            return Redirect::route('access.denied');
        }

        $delivred_bubbles = null;
        if (Auth::check() && Session::has('lang_strip_to')) {
            $delivred_bubbles = $strip->bubbles()
                    ->where('user_id', '=', Auth::id())
                    ->where('lang_id', '=', Session::get('lang_strip_to'))
                    ->first();
        }
        $available_languages = DB::table('languages')->join('bubbles', 'bubbles.lang_id', '=', 'languages.id')
                ->where('bubbles.strip_id', '=', $strip->id)
                ->whereNotNull('bubbles.validated_at')
                ->orWhere(function ($q) use($strip) {
                    $q->where('user_id', '=', Auth::id())
                    ->where('lang_id', '=', $strip->comic->lang_id);
                })
                ->select('languages.id', 'languages.label')
                ->lists('label', 'id');

        $translate_languages = DB::table('languages')->where('languages.id', '<>', $strip->comic->lang_id)->lists('label', 'id');
        View::share([
            'available_languages' => $available_languages,
            'translate_languages' => $translate_languages,
            'lang_strip_to' => Session::has('lang_strip_to') ? Session::get('lang_strip_to') : 0,
            'lang_strip' => Session::has('lang_strip') ? Session::get('lang_strip') : 1,
            'fonts' => Font::all()->lists('name', 'name'),
            'font_id' => Font::find($strip->comic->font_id)->name,
            'strip' => $strip,
            'bubble' => $delivred_bubbles !== null ? $delivred_bubbles : new Bubble(),
            'canvas_original' => $this->mergeShapesAndBubblesJSON($shapes, $original_bubbles),
            'canvas_delivered' => $this->mergeShapesAndBubblesJSON($shapes, $delivred_bubbles !== null ? $delivred_bubbles : $original_bubbles),
            'strip_height' => $this->getHeight($shapes->value),
            'strip_width' => $this->getWidth($shapes->value)
        ]);
        return View::make('strip.translate');
    }

    protected function saveTranslate($comic_id, $strip_id) {
        $strip = Strip::find($strip_id);
        if ($strip === null || !$strip->isTranslateable()) {
            return Redirect::route('access.denied');
        }

        $bubble = Bubble::find(Input::get('id'));
        if ($bubble == null) {
            $bubble = new Bubble();
        }

        if ($bubble->validated_at != null) {
            return Redirect::route('access.denied');
        }

        Session::put('lang_strip_to', Input::get('lang_id'));
        $bubble->lang_id = Input::get('lang_id');
        $bubble->strip_id = $strip_id;
        $bubble->value = $this->extractTextsFromJSON(Input::get('value'));

        if (Auth::check()) {
            $bubble->user_id = Auth::user()->id;
        }
        $bubble->save();

        return Redirect::route('strip.index', [
                    $comic_id
        ]);
    }

    /*
     * public function listPending() {
     * $strips = Strips::whereNull('validated_at')->get();
     * return View::make('strips.list', ['strips' => $strips]);
     * }
     *
     * public function validPending() {
     * $strip = Strips::find(Input::get('id'));
     * if ($strip == null) {
     * return Redirect::back()->withInput()->withErrors($v);
     * }
     * $strip->updated_at = new DateTime();
     * $strip->validated_at = new DateTime();
     * $strip->save();
     *
     * return Redirect::back()->with('message', Lang::get('strips.approved'));
     * }
     */

    private function mergeShapesAndBubblesJSON($shape, $bubble) {
        if ($bubble === null) {
            return $shape->value;
        }

        $jsonBubble = json_decode($bubble->value, true)['objects'];
        $json = '{"objects":' . json_encode(array_merge(json_decode($shape->value, true)['objects'], $jsonBubble)) . ',"background":"" }';
        return $json;
    }

    private function extractTextsFromJSON($json) {
        $json = json_decode($json, true);
        unset($json['objects'][0]); // Remove Image.
        foreach ($json['objects'] as $k => $v) {
            if ($v['type'] != 'i-text') {
                unset($json['objects'][$k]);
            }
        }

        return json_encode($json);
    }

    private function getHeight($shapes) {
        return json_decode($shapes, true)['objects'][0]['height'];
    }

    private function getWidth($shapes) {
        return json_decode($shapes, true)['objects'][0]['width'];
    }

}

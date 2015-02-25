<?php

use Transcomics\RoleRessource\RessourceDefinition;

class StripController extends BaseController {

    public function __construct() {
        $this->beforeFilter('auth', ['except' => ['index', 'show', 'clean', 'import', 'translate']]);
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
        
        if (!$strip->isShowable()) {
            return Redirect::route('access.denied');
        }

        $lang_strip = Session::has('lang_strip') ? Session::get('lang_strip') : $comic->lang_id;
        $shapes = $strip->getBestShapes(Auth::id());
        $bubbles = $strip->getBestBubbles($lang_strip, Auth::id());
        if ($bubbles === null) {
            $bubbles = $strip->getBestBubbles($strip->comic->lang_id, Auth::id());
        }
        
        $available_languages = DB::table('languages')
            ->join('bubbles', 'bubbles.lang_id', '=', 'languages.id')
            ->where('bubbles.strip_id', '=', $strip->id)
            ->where('bubbles.validated_state', ValidateEnum::VALIDATED)
            ->select('languages.id', 'languages.label')
            ->lists('label', 'id');

        View::share([
            /* Paginate. */
            'first_strip' => $comic->strips()->where('isShowable', true)->orderBy('id')->first(),
            'previous_strip' => $comic->strips()->where('isShowable', true)->where('id', '<', $strip->id)->orderBy('id', 'desc')->first(),
            'random_strip' => $comic->strips()->where('isShowable', true)->where('id', '<>', $strip->id)->orderByRaw('RAND()')->first(),
            'next_strip' => $comic->strips()->where('isShowable', true)->where('id', '>', $strip->id)->orderBy('id')->first(),
            'last_strip' => $comic->strips()->where('isShowable', true)->orderBy('id', 'desc')->first(),
            'available_languages' => $available_languages,
            'lang_strip' => $lang_strip,
            'bubble_id' => $bubbles->id,
            'canvas' => $this->mergeShapesAndBubblesJSON($shapes, $bubbles),
            'canvas_height' => $this->getHeight($shapes->value),
            'canvas_width' => $this->getWidth($shapes->value)
        ]);

        return View::make('strip.show', [
                'strips' => $strip
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($comic_id) {

        $comic = Comic::find($comic_id);
        if ($comic == null) {
            return Redirect::route('comic.index');
        }

        if ($comic->strips->count() < 1) {
            return Redirect::route('comic.index');
        }

        if (RoleRessource::isAllowed('M', RessourceDefinition::Comics, $comic_id, Auth::id())) {
            $strips = $comic->strips();
        } else {
            $strips = $comic->strips()->where(function ($q) {
                $q->where('isShowable', TRUE)
                    ->orWhere('user_id', Auth::id());
            });
        }

        return View::make('strip.index', [
            'comic' => $comic,
            'strips' => $comic->strips()->where(function ($q) {
                            $q->where('validated_state', ValidateEnum::VALIDATED)
                            ->orWhere('user_id', Auth::check() ? Auth::id() : 0);
                        })->paginate(Session::has('paginate') ? Session::get('paginate') : 12),
            'nb_pending' => $comic->strips()->wherevalidated_state(ValidateEnum::PENDING)->count()
        ]);
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

        $files = Input::file('strips');
        foreach ($files as $file) {
            $valid = Validator::make([
                    'strip' => $file,
                    'title' => Input::get('title')
                    ], Strip::$rules);
            if ($valid->fails()) {
                return Redirect::back()->withInput()->withErrors($valid);
            } else {
                $fileLocation = UploadFile::uploadFile($file);

                $strip = new Strip();
                $strip->title = Input::get('title');
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
        return Redirect::back()->with('message', Lang::get('strips.deleteSucceded'));
    }

    public function indexModerate($comic_id) {
        $comic = Comic::find($comic_id);
        if ($comic == null) {
            return Redirect::route('strip.index');
        }

        $strip = $comic->strips()->wherevalidated_state(ValidateEnum::PENDING);

        if ($strip->count()) {
            return View::make('strip.moderate')->with('strip', $strip->get()
                        ->random());
        }
        return Redirect::route('strip.index');
    }

    public function moderate($comic_id) {
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

        $strip = $comic->strips()->wherevalidated_state(ValidateEnum::PENDING);

        if ($strip->count()) {
            return View::make('strip.moderate')->with('strip', $strip->get()
                        ->random());
        }
        return Redirect::route('strip.index', $comic_id);
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
        $shape = $strip->getBestShapes(Auth::id());
        
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
        
        $lang_from = Session::has('lang_strip') ? Session::get('lang_strip') : $strip->comic->lang_id;
        $lang_to = Session::has('lang_strip_to') ? Session::get('lang_strip_to') : $strip->comic->lang_id;
        $lang_available_from = $strip->getLanguagesWithTranslate(Auth::id())->lists('label', 'id');
        $lang_available_to = $strip->getLanguagesToTranslate()->lists('label', 'id');
        
        $shapes = $strip->getBestShapes(Auth::id());
        $best_bubbles = $strip->getBestBubbles($lang_from, Auth::id());
        $delivred_bubbles = $strip->getBubblesToEdit($lang_to, Auth::id());
        // FIXE ME GET BEST $LANG_TO
        
        if ($best_bubbles === null) {
            return Redirect::route('access.denied');
        }

        View::share([
            'available_languages' => $lang_available_from,
            'translate_languages' => $lang_available_to,
            'lang_strip_to' => $lang_to,
            'lang_strip' => $lang_from,
            'fonts' => Font::all()->lists('name', 'name'),
            'font_id' => Font::find($strip->comic->font_id)->name,
            'strip' => $strip,
            'bubble' => $delivred_bubbles !== null ? $delivred_bubbles : new Bubble(),
            'canvas_original' => $this->mergeShapesAndBubblesJSON($shapes, $best_bubbles),
            'canvas_delivered' => $this->mergeShapesAndBubblesJSON($shapes, $delivred_bubbles !== null ? $delivred_bubbles : $best_bubbles),
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

<?php
use Symfony\Component\Process\Exception\InvalidArgumentException;

class ComicController extends BaseController {

    public function __construct() {
        $this->beforeFilter('auth', [
            'except' => [
                'index',
                'show'
            ]
        ]);
    }

    public function index() {
        return View::make('comic.index', [
            'comics' => Comic::paginate(Session::has('paginate') ? Session::get('paginate') : 10)
        ]);
    }

    public function create() {
        $this->prepareForm();
        return View::make('comic.create', [
            'comic' => new Comic()
        ]);
    }

    public function edit($id) {
        $c = Comic::find($id);
        if ($c == null) {
            return Redirect::route('comic.create');
        }
        
        $this->prepareForm();
        return View::make('comic.edit', [
            'comic' => $c
        ]);
    }

    public function store() {
        return $this->checkAndSave(new Comic(), function ($c, $v, $isOk) {
            
            if ($isOk) {
                return Redirect::route('comic.index')->withMessage(Lang::get('comic.added', [
                    'title' => $c->title
                ]));
            }
            return Redirect::route('comic.create')->withInput()
                ->withErrors($v)
                ->withMessage(Lang::get('comic.errorMessage'));
        });
    }

    public function update($id) {
        return $this->checkAndSave(Comic::find($id), function ($c, $v, $isOk) {
            
            if ($isOk) {
                return Redirect::route('comic.update', [
                    $c->id
                ])->withMessage(Lang::get('comic.updated', [
                    'title' => $c->title
                ]));
            }
            
            return Redirect::route('comic.edit', [
                $c->id
            ])->withInput()
                ->withErrors($v)
                ->withMessage(Lang::get('comic.errorMessage'));
        });
    }

    public function destroy($id) {
        $comic = Comic::find($id);
        if ($comic == null) {
            return Redirect::route('home');
        }
        
        $comic->strips->each(function ($strip) {
            Strip::dropFile($strip->path);
            $strip->delete();
        });
        
        Comic::dropFile($comic->cover);
        $comic->delete();
        
        return Redirect::back();
    }

    private function checkAndSave($comic, $return) {
        $v = Validator::make(Input::all(), [
            'title' => 'required|between:4,63|unique:comics,title,' . $comic->id,
            'author' => 'required|between:4,63',
            'description' => 'max:2000',
            'authorApproval' => 'accepted|boolean',
            'cover' => 'image|mimes:png,jpeg|between:40,4096',
            'font_id' => 'required|numeric',
            'lang_id' => 'required|numeric'
        ]);
        
        $isOk = $v->passes();
        if ($isOk) {
            $comic->title = Input::get('title');
            $comic->author = Input::get('author');
            $comic->description = nl2br(Input::get('description'));
            $comic->authorApproval = Input::get('authorApproval');
            if (Input::hasFile('cover')) {
                Comic::dropFile($comic->cover);
                $comic->cover = Comic::uploadFile(Input::file('cover'));
            }
            $comic->font_id = Input::get('font_id');
            $comic->lang_id = Input::get('lang_id');
            $comic->created_by = Auth::id();
            $comic->save();
        }
        
        return $return($comic, $v, $isOk);
    }

    public function show($id) {
        $comic = Comic::find($id);
        if ($comic == null) {
            return Redirect::route('home');
        }
        
        $strips = $comic->strips()
            ->where('isShowable', TRUE)
            ->orderBy('validated_at', 'desc')
            ->take(3)
            ->get();
        return View::make('comic.show', [
            'comic' => $comic,
            'strips' => $strips
        ]);
    }

    private function prepareForm() {
        View::share([
            'fonts' => Font::all()->lists('name', 'id'),
            'comic_languages' => Language::all()->lists('label', 'id')
        ]);
    }

    public function indexModerate() {
        $comic = Comic::wherevalidated_state(ValidateEnum::PENDING);
        
        if ($comic->count()) {
            return View::make('comic.moderate')->with('comic', $comic->get()
                ->random());
        }
        return Redirect::route('comic.index');
    }

    public function moderate() {
        $comic_id = Input::get('comic_id');
        $choice = Input::get('choice');
        
        $comic = Comic::find($comic_id);
        if ($comic == null) {
            return Redirect::route('home');
        }
        
        $comic->validated_by = Auth::id();
        $comic->validated_at = new DateTime();
        switch ($choice) {
            case 'accept':
                $comic->validated_state = ValidateEnum::VALIDATED;
                $comic->save();
                break;
            case 'refuse':
                $comment = Input::get('comment');
                if (empty($comment)) {
                    return Redirect::route('comic.moderate')->withcomic($comic)->withMessage(Lang::get('moderate.missing_comment'));
                }
                
                $comic->validated_state = ValidateEnum::REFUSED;
                $comic->validated_comments = $comment;
                $comic->save();
                
                if (Input::has('delete')) {
                    $comic->strips->each(function ($strip) {
                        Strip::dropFile($strip->path);
                        $strip->delete();
                        
                        Comic::dropFile($comic->cover);
                        $comic->delete();
                    });
                }
                break;
            default:
                throw new InvalidArgumentException();
        }
        
        $comic = Comic::wherevalidated_state(ValidateEnum::PENDING)->get()->random();
        if ($comic == null) {
          return Redirect::route('comic.index');
        }
        return Redirect::route('comic.moderate')->withcomic($comic);
    }
}

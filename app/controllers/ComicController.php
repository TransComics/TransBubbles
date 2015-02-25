<?php

use Transcomics\RoleRessource\RessourceDefinition;

class ComicController extends BaseController {

    public function __construct() {
        $this->beforeFilter('auth', ['except' => ['index', 'show']]);
        $this->beforeFilter('access', ['only' => ['show', 'edit', 'update', 'destroy']]);
    }

    public function index() {
        $paginate = Session::has('paginate') ? Session::get('paginate') : 10;

        View::share([
            'comics' => Comic::getComicToDisplay()->paginate($paginate),
            'nb_pending' => Comic::getNbPending()
        ]);
        return View::make('comic.index');
    }

    public function create() {
        Form::setValidation(ComicController::getRules());
        $this->prepareForm();

        View::share([
            'comic' => new Comic()
        ]);

        return View::make('comic.create');
    }

    public function edit($id) {
        $comic = Comic::find($id);
        if ($comic == null) {
            return Redirect::route('comic.create');
        }

        Form::setValidation(ComicController::getRules($id));
        $this->prepareForm();
        return View::make('comic.edit', [
                    'comic' => $comic
        ]);
    }

    public function store() {
        $v = Validator::make(Input::all(), ComicController::getRules());

        if ($v->passes()) {
            $comic = new Comic();

            $comic->fill(Input::only(
                            'title', 'author', 'authorApproval', 'font_id', 'lang_id'
            ));

            $comic->description = nl2br(Input::get('description'));
            if (Input::hasFile('cover')) {
                Comic::dropFile($comic->cover);
                $comic->cover = Comic::uploadFile(Input::file('cover'));
            }
            $comic->created_by = Auth::id();
            $comic->validated_state = ValidateEnum::PENDING;
            $comic->save();

            RoleRessource::addRight(2, RessourceDefinition::Comics, $comic->id, Auth::id());
            return Redirect::route('comic.index')->withMessage(Lang::get('comic.added', [
                                'title' => $comic->title
            ]));
        }
        return Redirect::route('comic.create')->withInput()
                        ->withErrors($v)
                        ->withMessage(Lang::get('comic.errorMessage'));
    }

    public function update($id) {

        $comic = Comic::findOrFail($id);
        $v = Validator::make(Input::all(), ComicController::getRules($comic->id));

        if ($v->passes()) {
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
<<<<<<< HEAD
            $comic->validated_state = ValidateEnum::PENDING;
=======
            if ($comic->validated_state == ValidateEnum::REFUSED) {
                $comic->validated_state = ValidateEnum::PENDING;
            }
>>>>>>> refs/remotes/origin/develop
            $comic->save();

            return Redirect::route('comic.update', [
                        $comic->id
                    ])->withMessage(Lang::get('comic.updated', [
                                'title' => $comic->title
            ]));
        }

        return Redirect::route('comic.edit', [$comic->id])
                        ->withInput()
                        ->withErrors($v)
                        ->withMessage(Lang::get('comic.errorMessage'));
    }

    public function destroy($id) {
        $comic = Comic::find($id);
        if ($comic == null) {
            return Redirect::route('home');
        }

        $comic->strips->each(function($strip) {
            Strip::dropFile($strip->path);
            $strip->delete();
        });

        $this->removeRightOnComic($id, $comic->created_by);
        
        Comic::dropFile($comic->cover);
        $comic->delete();



        return Redirect::back();
    }

    private function removeRightOnComic($comic_id, $user_id) {

        $role_ressource = RoleRessource::where('ressource', RessourceDefinition::Comics)
                ->where('ressource_id', $comic_id)
                ->where('user_id', $user_id)
                ->first();
        
        if (empty($role_ressource)) {
            Log::error('Error when removing right of user $user_id on the strip $strip_id after moderation');
        } else {
            $role_ressource->delete();
        }
    }

    public function show($id) {
        $comic = Comic::find($id);
        if ($comic == null) {
            return Redirect::route('home');
        }
        
        return View::make('comic.show', [
            'comic' => $comic,
            'strips' => $comic->stripsShowable(3)
        ]);
    }

    private function prepareForm() {
        View::share([
            'fonts' => Font::all()->lists('name', 'id'),
            'comic_languages' => Language::all()->lists('label', 'id')
        ]);
    }

    public function indexModerate() {
        $comic = Comic::where('validated_state', ValidateEnum::PENDING);

        if ($comic->count()) {
            return View::make('comic.moderate')->with('comic', $comic->get()->random());
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
        $user = User::find($comic->created_by);

        switch ($choice) {
            case 'accept':
                $comic->validated_state = ValidateEnum::VALIDATED;
                $comic->save();
                if (!empty($user)) {
                    Mail::send('emails.accept_moderation', [
                        'username' => $user->username
                            ], function ($message) use($user) {
                        $message->to($user->email, $user->username)->subject(Lang::get('moderate.accepted_comic'));
                    });
                }
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


                if (!empty($user)) {
                    Mail::send('emails.refuse_moderation', [
                        'deleted' => Input::has('delete'),
                        'comment' => $comment,
                        'username' => $user->username
                            ], function ($message) use($user) {
                        $message->to($user->email, $user->username)->subject(Lang::get('moderate.refused_comic'));
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

    private static function getRules($id = null) {
        return [
            'title' => 'required|between:4,63|unique:comics,title,' . $id,
            'author' => 'required|between:4,63',
            'description' => 'max:2000',
            'authorApproval' => 'accepted|boolean|required',
            'cover' => 'image|mimes:png,jpeg|between:20,4096',
            'font_id' => 'required|numeric',
            'lang_id' => 'required|numeric'
        ];
    }

}

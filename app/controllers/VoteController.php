<?php

class VoteController extends \BaseController {
    public function __construct() {
        $this->beforeFilter('auth');
    }

    public function index($comic_id, $strip_id, $bubble_id = null) {
        $comic = Comic::find($comic_id);
        if ($comic == null) {
            return Redirect::route('comic.index');
        }
        
        $strip = $comic->strips->find($strip_id);
        if ($strip == null) {
            return Redirect::route('comic.index');
        }
        
        $lang_from = Session::has('lang_strip') ? Session::get('lang_strip') : $strip->comic->lang_id;
        $lang_available_from = $strip->getLanguagesWithTranslate()->where('languages.id', '<>', $strip->comic->lang_id)->lists('label', 'id');
            
        
        $bubbles = $strip->bubbles()->where('lang_id', $lang_from)
                                    ->where('validated_state',  ValidateEnum::VALIDATED)->get();
        if ($bubbles == null) {
            return Redirect::route('comic.index');
        }
        
        $bubble = ($bubble_id == null)? $bubbles->first() : Bubble::find($bubble_id);
        if ($bubble == null) {
            return Redirect::route('comic.index');
        }
        if($bubble->lang_id != $lang_from) {
            return Redirect::route('strip.vote', [$comic_id, $strip_id]);
        }
        
        $shapes = $strip->getBestShapes();
        if ($shapes == null) {
            return Redirect::route('comic.index');
        }
        
        return View::make('vote.index', [
            'available_languages' => $lang_available_from,
            'lang_strip' => $lang_from,
            'strip' => $strip,
            'comic' => $comic,
            'bubbles' => $bubbles,
            'bubble_id' => $bubble->id,
            'canvas' => $this->mergeShapesAndBubblesJSON($shapes, $bubble),
            'canvas_height' => $this->getHeight($shapes->value),
            'canvas_width' => $this->getWidth($shapes->value)
        ])->with('lang', Input::get('lang'));
    }

    public function store($comic_id, $strip_id, $bubble_id) {
        $user_id = Input::get('user_id');
        $bubble_id = Input::get('bubble_id');
        $strip_id = Input::get('strip_id');
        $lang_id = Input::get('lang_id');
        
        \Log::info('-----VALUE : ' . $user_id . ' ' . $bubble_id . ' ' . $strip_id . ' ' . $lang_id);
        
        if (! isset($user_id) || ! isset($bubble_id) || ! isset($strip_id) || ! isset($lang_id)) {
            $response = array(
                'status' => 'error',
                'msg' => Lang::get('vote.null_value')
            );
            return Response::json($response);
        }
        
        $vote = Vote::whereuser_id($user_id)->wherestrip_id($strip_id)->wherelang_id($lang_id);
        
        if ($vote->count() > 0) {
            $vote->update(array('bubble_id' => $bubble_id));
            
            $response = array(
                'status' => 'revote',
                'msg' => Lang::get('vote.revote'),
                'vote_count' => $vote->count()
            );
            return Response::json($response);
        } else {
            
            $vote = new Vote();
            $vote->user_id = $user_id;
            $vote->bubble_id = $bubble_id;
            $vote->strip_id = $strip_id;
            $vote->lang_id = $lang_id;
            $vote->save();
            
            $response = array(
                'status' => 'success',
                'msg' => Lang::get('vote.success'),
                'vote_count' => $vote->count()
            );
            return Response::json($response);
        }
        
        $response = array(
            'status' => 'error',
            'msg' => Lang::get('vote.unexpected')
        );
        return Response::json($response);
    }

    private function mergeShapesAndBubblesJSON($shape, $bubble) {
        if ($bubble === null) {
            return $shape->value;
        }

        $jsonBubble = json_decode($bubble->value, true)['objects'];
        $json = '{"objects":' .
            json_encode(array_merge(
                    json_decode($shape->value, true)['objects'], $jsonBubble)) .
            ',"background":"" }';

        return $json;
    }
    
    private function getHeight($shapes) {
        return json_decode($shapes, true)['objects'][0]['height'];
    }

    private function getWidth($shapes) {
        return json_decode($shapes, true)['objects'][0]['width'];
    }

}

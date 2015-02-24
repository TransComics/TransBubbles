<?php

class VoteController extends \BaseController {
    public function __construct() {
        $this->beforeFilter('auth');
    }

    public function index($comic_id, $strip_id) {
        $comic = Comic::find($comic_id);
        if ($comic == null) {
            return Redirect::route('comic.index');
        }
        
        $strip = $comic->strips->find($strip_id);
        if ($strip == null) {
            return Redirect::route('comic.index');
        }
        
        $bubbles = $strip->bubbles()->where('lang_id', Input::get('lang'))->whereNotNull('validated_at')->get();
        if ($bubbles == null) {
            return Redirect::route('comic.index');
        }
        
        $shapes = $strip->shapes()->whereNotNull('validated_at')->first();
        if ($shapes == null) {
            return Redirect::route('comic.index');
        }
        
        return View::make('vote.index', [
            'strip' => $strip,
            'comic' => $comic,
            'bubbles' => $bubbles,
            'bubble_id' => $bubbles->first()->id,
            'canvas' => $this->mergeShapesAndBubblesJSON($shapes, $bubbles->first()),
            'canvas_height' => $this->getHeight($shapes->value),
            'canvas_width' => $this->getWidth($shapes->value)
        ])->with('lang', Input::get('lang'));
    }

    public function store($comic_id, $strip_id) {
        $user_id = Input::get('user_id');
        $bubble_id = Input::get('bubble_id');
        $strip_id = Input::get('strip_id');
        $lang = Language::where('shortcode', '=', Input::get('lang_id'))->first();
        
        \Log::info('-----VALUE : ' . $user_id . ' ' . $bubble_id . ' ' . $strip_id . ' ' . $lang->id);
        
        if (! isset($user_id) || ! isset($bubble_id) || ! isset($strip_id) || ! isset($lang->id)) {
            $response = array(
                'status' => 'error',
                'msg' => Lang::get('vote.null_value')
            );
            return Response::json($response);
        }
        
        $vote = Vote::whereuser_id($user_id)->wherestrip_id($strip_id)->wherelang_id($lang->id);
        
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
            $vote->lang_id = $lang->id;
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

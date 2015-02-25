<?php

class PopularitiesController extends \BaseController {
    
    // RESTFUL
    protected static $restful = true;


    private $duration = 1440;

    /**
     * Display the specified resource.
     *
     * @param int $id            
     * @return Response
     */
    public function update($id) {
       /*
        $cookieValue=json_decode(Cookie::get('Transbubbles-Popularities'.$id));
        //Detect if the user has already voted for this strip
        //if there is no cookie
        if(empty($cookieValue)){
            $cookieValue=[
                    $id=>'1'
            ];
            $cookie=Cookie::make('Transbubbles-Popularities'.$id, json_encode($cookieValue), 1440);
        }
        //else, we will check the cookie
        else{
            //if the user didn't vote with this popularity
            if($cookieValue[$id]==0){
                $cookieValue[$id]=1;
            }
            //else, we return an error, specifying that he already voted
            else{
                return Response::json([
                    'status'=>'error',
                    'description'=> 'already voted'
                ])->withCookie($cookie);
            }
        }
        */
         $cookieValue=Cookie::get('Transbubbles-Popularities'.$id);
        //Detect if the user has already voted for this strip
        //If so, we return an error, specifying that he already voted
        if(!empty($cookieValue)){
            return Response::json([
                'status'=>'success',
                'description'=> 'already voted',
                'voted'=>true
            ]);
        }
        //retrieve vote type clicked
        $type= Input::get("type");
        if (Request::ajax()){
            //retrieve corresponding entry
            $entry = Popularities::find($id);
            //update the vote count with the type chosen
            if($type=='down')
                $entry->vote_down++;
            else if($type=='up')
                $entry->vote_up++;
            $entry->save();
                
            //get counters
                $countup=$entry->vote_up;
                $countdown=$entry->vote_down;
            $response= [
                'popularity_id'=>$entry->id,
                'strip_id'=>$entry->strip_id,
                'status'=>'success',
                'up'=> "$countup" ,
                'down'=>"$countdown"
            ];
            $cookie=Cookie::make('Transbubbles-Popularities'.$id, $id, 1440);
            $response=Response::json($response);
            $response->headers->setCookie($cookie);
            //return json_encode($response);
            return $response;
        } 
        else return Response::json([
            'status'=>'error',
        ]);
    }
}

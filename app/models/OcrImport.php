<?php

class OcrImport {

    public function tesseract($data){
        $url = getenv('OCR_URL');
        
        //POST_PARAMS : image URI & engine, in json type
        $datajson = array("img_url" => URL::to('/').'/'.$data['img_url'], 
                      "engine" => getenv('OCR_ENGINE'),
                      "lang" => Language::find(1)->codeiso
                     );
        $postParams = json_encode($datajson);
        \Log::debug('OCR postParams :' . $postParams);
        
        // Set HTTP POST Request+Params
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postParams);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($postParams))
        );
        
        $result = curl_exec($ch);
        \Log::info('OCR strResponse:' . $result);
        
        // Close the Curl Session.
        curl_close($ch);
        
        return $result;
    }
    
    public function fire($job,$data){
        //OCR URL Determination
        if( getenv('OCR_ENGINE') == 'tesseract'){
            $text = OcrImport::tesseract($data);
        }
        else{/*TODO FIX : no other OCR platform for now, abort the detection*/
          $job-> delete();//delete jobs from the queue
        }

        //split imported text to insert to the strip, with the format used by FabricJS (htmlspecialchars mandatory)
        $texts = preg_split("/\n\n/", htmlspecialchars($text,0,"UTF-8"));
        if (empty(trim($texts)))
            $job->delete();//No insertion into DB if the content is null.
        $i=0;
        foreach ($texts as $value) {
            if (empty(trim($value))){
            $bubbleValue['objects']["indexi-text_$i"]=array('type'=>'i-text','text'=>$value,'top'=>0,'left'=>0,'fontSize'=>"14",'textAlign'=>'center');
            $i++;
            }
        }
        $bubbleValue['background']='';

        //remove 'indexi-text_' to keep the index number
        $patterns = array('/indexi-text_/');
		$replacements = array('');
        $bubbles =preg_replace($patterns, $replacements, json_encode($bubbleValue));
        
        //store the imported text into Bubbles table
        $bubble = new Bubble();
            $bubble->lang_id = $data['lang_id'];
            $bubble->strip_id = $data['strip_id'];
            $bubble->user_id = $data['user_id'];
            $bubble->value= $bubbles;
            $bubble->save();
    
        $job-> delete();//delete jobs from the queue
    }

    
}
?>

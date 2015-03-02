<?php

class OcrImport {

    public function tesseract($data) {
        $url = getenv('OCR_URL');
        
        // POST_PARAMS : image URI & engine, in json type
        $datajson = array(
            "img_url" => URL::to('/') . '/' . $data['img_url'],
            "engine" => getenv('OCR_ENGINE'),
            "lang" => Language::find($data['lang_id'])->codeiso
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
            'Content-Length: ' . strlen($postParams)
        ));
        
        $result = curl_exec($ch);
        \Log::info('OCR strResponse:' . $result);
        
        // Close the Curl Session.
        curl_close($ch);
        
        return $result;
    }

    public function fire($job, $data) {
        // OCR URL Determination
        switch (getenv('OCR_ENGINE')) {
            case 'tesseract':
                $text = OcrImport::tesseract($data);
                break;
            default:
                $job->delete(); // delete jobs from the queue
                return;
        }
         
        // split imported text to insert to the strip, with the format used by FabricJS (htmlspecialchars mandatory)
        $text = trim($text);
        if (empty($text)) {
            $job->delete(); // No insertion into DB if the content is null.
            return;
        }
        $text = preg_replace('/[><]/','*', $text);
        $texts = explode("\n\n", $text);
        
        $i=1;
        foreach ($texts as $text) {
            
            $text = trim($text);
            if (!empty($text)) {
                $bubbleValue['objects']['index_'.$i] = array(
                    'type' => 'i-text',
                    'left' => 0,
                    'top' => 0,
                    'width' => 200,
                    'height'=>100,
                    'text' => $text,
                    'fontSize' => '14',
                    "fontFamily"=>"Arial",
                    'textAlign' => 'center',
                    'styles'=>[]
                );
                $i++;
            }
        }
        $bubbleValue['background'] = '';
        
        // remove 'indexi-text_' to keep the index number
        $patterns = 'index_';
        $replacements ='';
        $bubbles = str_replace($patterns, $replacements, json_encode($bubbleValue));
        
        // store the imported text into Bubbles table
        $bubble = new Bubble();
        $bubble->lang_id = $data['lang_id'];
        $bubble->strip_id = $data['strip_id'];
        $bubble->user_id = $data['user_id'];
        $bubble->value = $bubbles;
        $bubble->validated_state = ValidateEnum::REFUSED;
        $bubble->save();
        
        $job->delete(); // delete jobs from the queue
    }
}
?>

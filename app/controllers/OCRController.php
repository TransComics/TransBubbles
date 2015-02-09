<?php
use Ddeboer\Tesseract\Tesseract;
class OCRController extends BaseController {
	
    public function performOCR() {
		$tesseract = new Tesseract();

		$mode = Tesseract::PAGE_SEG_MODE_OSD; 
		$text = $tesseract->recognize('images/ocrtemp/test2.jpg',array('eng'));
		//$text = $tesseract->recognize('images/ocrtemp/eng.xkcd.exp1.png',array('eng','fra') , $mode);
echo getcwd();
        return View::make('ocr.perform')->withText($text);
    }
  	
  
}

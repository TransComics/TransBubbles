<?php
use Ddeboer\Tesseract\Tesseract;
class OCRController extends BaseController {
	
    public function performOCR() {
		$tesseract = new Tesseract();
		$version = $tesseract->getVersion();
		//$languages = $tesseract->getSupportedLanguages();
		//$text = $tesseract->recognize('images/ocrtemp/test.jpg',array('eng'));
		$text = $tesseract->recognize('images/ocrtemp/eng.xkcd.exp1.png',array('eng','fra') , Tesseract::PAGE_SEG_MODE_AUTOMATIC_OCR);
		echo $text;

        return View::make('ocr.perform');
        //return View::make('ocr.perform')->with('text', $text);
    }
  
  
}

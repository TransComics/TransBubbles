<?php
use Ddeboer\Tesseract\Tesseract;
class OCRController extends BaseController {
	
    /* Analyze an image with our own locally installed Tesseract, and return a view with the text*/
    public function performLocalOCR() {
		$tesseract = new Tesseract();
		$mode = Tesseract::PAGE_SEG_MODE_OSD;
/*Reminder
    	const PAGE_SEG_MODE_OSD = 0;
        const PAGE_SEG_MODE_AUTOMATIC_OSD = 1;
        const PAGE_SEG_MODE_AUTOMATIC = 2;
        const PAGE_SEG_MODE_AUTOMATIC_OCR = 3;
        const PAGE_SEG_MODE_SINGLE_COLUMN = 4;
        const PAGE_SEG_MODE_SINGLE_BLOCK_VERTICAL = 5;
        const PAGE_SEG_MODE_SINGLE_BLOCK = 6;
        const PAGE_SEG_MODE_SINGLE_LINE = 7;
        const PAGE_SEG_MODE_SINGLE_WORD = 8;
        const PAGE_SEG_MODE_SINGLE_WORD_CIRCLE = 9;
        const PAGE_SEG_MODE_SINGLE_CHARACTER = 10;
*/

        $image='images/ocrtemp/test3.jpg';//adresse locale, racine "public"
		$lang= array('eng');
		$text = $tesseract->recognize($image,$lang);
        return View::make('ocr.perform', array('text' => $text, 'image' => $image));


 		
		
        //$text = $tesseract->recognize($image,$lang,$mode);//Don't use , issue with temporary file
        //echo getcwd();//public directory. Just a reminder.        
        //return View::make('ocr.perform')->withText($text);
    }
}

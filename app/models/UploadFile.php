<?php

trait UploadFile {
    
    public static function uploadFile($file) {
        $path = '/uploads';
        $fullpath = public_path().'/uploads';
        $filename = md5(time().$file->getClientOriginalName()); //.'.'.$file->guessClientExtension();
        
        $index = count(File::directories($fullpath));
        if (!File::exists($fullpath.'/'.$index) || count(File::files($fullpath.'/'.$index)) >= 2000) {
            File::makeDirectory($fullpath.'/'.++$index);
        }
        $file->move($fullpath.'/'.$index, $filename);
        
        return $path.'/'.$index.'/'.$filename;
    }
    
    public static function dropFile($filepath) {
        return File::delete(public_path().$filepath);
    }
    
}
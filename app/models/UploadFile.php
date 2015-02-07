<?php

use Illuminate\Filesystem\Filesystem;

trait UploadFile {
    
    public static function upload($file) {
        $dir = public_path().'/uploads/';
        $filename = md5(time().$file->getClientOriginalName());
        $fs = new Filesystem();
        
        $index = count(File::directories($dir));
        if ($fs->exists($dir.'/'.$index) && count(File::files($dir.'/'.$index)) < 2000) {
            $dir .= '/'.$index;
        } else {
            $fs->makeDirectory($dir.'/'.++$index);
            $dir .= '/'.$index;
        }
        $file->move($dir, $filename);
    }
    
}
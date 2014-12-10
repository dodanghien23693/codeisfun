<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class FileController extends BaseController {
    
    static function getUrlFileUploaded($file,$dir)
    {
            $file_name = $file->getClientOriginalName().str_random(16);
            $extension =$file->getClientOriginalExtension();
            $new_file_name = $file_name.'.'.$extension;
            $file->move($dir,$new_file_name);
            return asset($dir.$new_file_name);
            
    }
    
    static function deleteFile($url)
    {
        $old_file = str_replace(FileController::getBaseUrl().'/', '', $url);
        File::delete($old_file);
    }
    
    static function getBaseUrl()
    {
        return sprintf(
            "%s://%s",
            isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
            $_SERVER['HTTP_HOST']
        );
    }

}


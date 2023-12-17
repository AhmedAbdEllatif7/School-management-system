<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait AttachFilesTrait
{
    public static function uploadFile($request,$name,$folder)
    {
        $file_name = $request->file($name)->getClientOriginalName();
        $request->file($name)->storeAs('',$folder.'/'.$file_name,'upload_attachments');
        
        return $file_name;
    }

    public static function deleteFile($path)
    {
        $pathExists = Storage::disk('upload_attachments')->exists($path);

        if($pathExists)
        {
            Storage::disk('upload_attachments')->delete($path);
        }
    }
}

<?php
namespace App\Traits;

use Illuminate\Http\Request;

trait FileUploadTrait {
    //delete image if exists
    public function handleFileUpload(Request $request, string $fileName,?string $oldPath=null,  string $dir='uploads'): ?String {
        //check if has image 
        if(!$request->hasFile($fileName)) {
            return null;
        }
        //delete old image
        if($oldPath && file_exists(public_path(($oldPath)))) {
             unlink($oldPath);
        }
        //save new image
       $file = $request->file($fileName);
       $extension =$file->getClientOriginalExtension();
       $updateFileName=\Str::random(10).'.'.$extension;

       $file->move(public_path($dir), $updateFileName);
       $filePath = $dir.'/'.$updateFileName;
       return $filePath;

    }
}
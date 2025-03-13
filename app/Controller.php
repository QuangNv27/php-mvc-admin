<?php
namespace App;
class Controller
{
    public function uploadFile(array $file, $folder = null)
    {
        $fileTmpPath = $file['tmp_name'];
        $fileName = time() . '-' . $file['name'];
        $uploadDir = 'storage/uploads/'.$folder.'/';
        if(!is_dir($uploadDir)) {
            mkdir($uploadDir,0755,true);
        }
        $destPath = $uploadDir . $fileName;
        if(move_uploaded_file($fileTmpPath, $destPath)) {
            return $destPath;
        } throw new \Exception('Loi upload');
    }
}
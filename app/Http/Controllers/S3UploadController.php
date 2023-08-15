<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class S3UploadController extends Controller
{
    public static function uploadFileToS3($file, $type)
    {
        try {
            $extension = $file->getClientOriginalExtension();
            $filename = uniqid() . '.' . $extension;

            $folder = $type === 'video' ? 'videos' : 'images';

            $file->storeAs($folder, $filename, 's3');

            return $filename;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function showContent($type, $fileName)
    {
        $fileContents = Storage::disk('s3')->get($type . '/' . $fileName);

        $contentType = Storage::disk('s3')->mimeType($type . '/' . $fileName);

        return new Response($fileContents, 200, [
            'Content-Type' => $contentType,
        ]);
    }
}

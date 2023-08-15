<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use FFMpeg\FFMpeg;

class S3UploadController extends Controller
{
    public static function uploadFileToS3($file, $type)
    {
        try {
            $extension = $file->getClientOriginalExtension();
            $filename = uniqid() . '.' . $extension;
            $folder = $type === 'video' ? 'videos' : 'images';
            $file->storeAs($folder, $filename, 's3');
    
            if ($type === 'video') {
                $ffmpeg = FFMpeg::create();
                $video = $ffmpeg->open($file->getRealPath());
                $duration = $video->getStreams()->first()->get('duration');
    
                return [
                    'filename' => $filename,
                    'duration' => $duration,
                ];
            }
    
            return [
                'filename' => $filename,
                'duration' => null,
            ];
        } catch (Exception $e) {
            return [
                'filename' => null,
                'duration' => null,
                'error' => $e->getMessage(),
            ];
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

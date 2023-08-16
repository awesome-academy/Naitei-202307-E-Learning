<?php

use App\Enrollment;

function formatSeconds($seconds)
{
    $minutes = floor($seconds / 60);
    $seconds %= 60;

    return sprintf('%02d:%02d', $minutes, $seconds);
}

function isAuthor($userId)
{
    if (auth()->check()) {
        return auth()->user()->id === $userId;
    }
    return false;
}

function hasEnrolled($userId, $courseId)
{
    return Enrollment::where('user_id', $userId)
        ->where('course_id', $courseId)
        ->exists();
}

function getMediaUrl($type, $fileName)
{
    $filePath = $type === 'videos' ? 'videos/' : 'images/';
    $cloudFrontUrl = env('CLOUDFRONT_URL');
    $url = $cloudFrontUrl . '/' . $filePath . $fileName;

    return $url;
}

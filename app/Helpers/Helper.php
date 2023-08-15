<?php

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

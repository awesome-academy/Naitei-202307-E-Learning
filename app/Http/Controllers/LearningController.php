<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;

class LearningController extends Controller
{
    public function show($id)
    {
        $course = Course::with('lessons')->find($id);

        return view('learning.show', compact('course'));
    }
}

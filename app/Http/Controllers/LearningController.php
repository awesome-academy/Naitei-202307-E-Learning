<?php

namespace App\Http\Controllers;

use App\Course;
use App\Lesson;
use App\User;
use Illuminate\Http\Request;

class LearningController extends Controller
{
    public function show($id)
    {
        $start_lesson = Lesson::select('id', 'course_id', 'title', 'description', 'video', 'duration')->find($id);
        $course = Course::find($start_lesson->course_id);
        $teacher = User::select('id', 'name', 'avatar')->find($course->teacher_id);

        return view('learning.show', compact('course', 'start_lesson', 'teacher'));
    }
}

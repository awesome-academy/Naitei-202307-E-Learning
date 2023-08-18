<?php

namespace App\Http\Controllers;

use App\Course;
use App\Enrollment;
use App\Lesson;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EnrollmentController extends Controller
{
    public function enrollCourse(Request $request)
    {
        $courseId = $request->course_id;
        $lesson = Lesson::where('course_id', $courseId)->first();
        
        if (!$lesson) {
            return redirect()->back()->with('error', __('Enroll in course failed! No lesson found'));
        }

        DB::beginTransaction();

        try {
            $user = Auth::user();
            $course = Course::find($courseId);
            if (!$user || !$course) {
                return view('courses.show', compact('course'))->with('error', __('Enroll in course failed!'));
            }

            $enrollment = new Enrollment();
            $enrollment->user()->associate($user);
            $enrollment->course()->associate($course);
            $enrollment->save();

            $course->enrolled_count = $course->enrolled_count + 1;
            $course->save();

            DB::commit();

            return view('courses.show', compact('course'))->with('success', __('Enrolled in course successfully!'));
        } catch (Exception $e) {
            DB::rollback();

            return redirect()->back()->with('error', __('Enroll in course failed!'));
        }
    }
}

<?php

namespace App\Http\Middleware;

use App\Course;
use App\Lesson;
use Closure;

class CheckAuthor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect()->route('courses.index')
                ->with('error', __('Unauthorized'));
        }

        $courseId = $request->route('course');
        $lessonId = $request->route('lesson');

        if (!$courseId) {
            $courseId = $request->query('course');
        }
        
        if ($lessonId) {
            $lesson = Lesson::find($lessonId);

            if (!$lesson) {
                return redirect()->route('courses.index')
                    ->with('error', __('Lesson not found'));
            }

            if ($lesson->course->teacher_id === auth()->user()->id) {
                return $next($request);
            }
        } elseif ($courseId) {
            $course = Course::find($courseId);



            if (!$course) {
                return redirect()->route('courses.index')
                    ->with('error', __('Course not found'));
            }

            if ($course->teacher_id === auth()->user()->id) {
                return $next($request);
            }
        }



        abort(403, __('Access denied'));
        return redirect()->route('courses.index')
            ->with('error', __('Access denied'));
    }
}

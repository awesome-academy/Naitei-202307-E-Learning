<?php

namespace App\Http\Middleware;

use App\Lesson;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckEnrolled
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
        $user = Auth::user();
        $lesson_id = $request->route('lesson');
        $lesson = Lesson::where('id', $lesson_id)->first();
        $course_id = $lesson->course_id;

        if (hasEnrolled($user->id, $course_id)) {
            return $next($request);
        }

        return redirect()->route('courses.show', $course_id)->with('error', __('You are not enrolled in this course'));
    }
}

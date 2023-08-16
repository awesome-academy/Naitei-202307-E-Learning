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
        $course_id = Lesson::find($lesson_id)->course->id;

        if (hasEnrolled($user->id, $course_id)) {
            return $next($request);
        }

        return redirect()->route('courses.show', $course_id)->with('error', __('You are not enrolled in this course'));
    }
}

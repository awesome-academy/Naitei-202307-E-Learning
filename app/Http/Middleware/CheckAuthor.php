<?php

namespace App\Http\Middleware;

use App\Course;
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
        if (!(auth()->check())) {
            abort(401, __('Unauthorized'));
        }

        $courseId = $request->route('course');
        $course = Course::find($courseId);

        if (!$course) {
            abort(404, __('Course not found'));
        }

        if ($course->teacher_id === auth()->user()->id) {
            return $next($request);
        }

        abort(403, __('Access denied'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;

class FindCourseController extends Controller
{
    public function findCourseByName(Request $request)
    {
        $perPage = config('constants.pagination.per_page');

        $name = $request->input('name');
        $courses = Course::where('name', 'like', "%$name%")
            ->with('user')
            ->paginate($perPage);

        return view('courses.index', compact('courses'));
    }
}

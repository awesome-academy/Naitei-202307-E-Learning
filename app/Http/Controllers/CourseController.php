<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Lesson;
use App\Progress;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = config('constant.pagination.per_page');

        $courses = Course::with('user')->paginate($perPage);

        return view('courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('courses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCourseRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $uploadResult = S3UploadController::uploadFileToS3($file, 'image');
            $filePath = $uploadResult['filename'];
        }

        $userId = auth()->user()->id;

        $course = Course::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'image' => $filePath,
            'teacher_id' => $userId,
        ]);

        return redirect()->route('courses.index')
            ->with('success', __('Course created successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = Course::with([
            'user',
            'lessons' => function ($query) {
                $query->select('id', 'course_id', 'title', 'description', 'duration');
            }
        ])->findOrFail($id);

        $continue_lesson = $this->continueLearning($id);

        return view('courses.show', compact('course', 'continue_lesson'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course = Course::find($id);

        return view('courses.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCourseRequest $request, $id)
    {
        $validated = $request->validated();

        $course = Course::find($id);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $uploadResult = S3UploadController::uploadFileToS3($file, 'image');
            $filePath = $uploadResult['filename'];

            $course->update([
                'name' => $validated['name'],
                'description' => $validated['description'],
                'image' => $filePath,
            ]);
        } else {
            $course->update([
                'name' => $validated['name'],
                'description' => $validated['description'],
            ]);
        }

        return redirect()->route('courses.show', ['course' => $course->id])
            ->with('success', __('Course updated successfully'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::find($id);

        $course->delete();

        return redirect()->route('courses.index')
            ->with('success', __('Course deleted successfully'));
    }

    public function continueLearning($id)
    {
        $user = Auth::user();

        $courseId = $id;
        $lesson = Lesson::where('course_id', $courseId)->first();

        if (!$lesson || !$user) {
            return null;
        }

        $progress = Progress::where('user_id', $user->id)
            ->where('completed', false)
            ->join('lessons', 'progress.lesson_id', '=', 'lessons.id')
            ->where('lessons.course_id', $courseId)
            ->select('progress.lesson_id', 'progress.progress')
            ->first();

        if ($progress) {
            $currentLessonId = $progress->lesson_id;

            return $currentLessonId;
        } else {
            $currentLessonId = Course::find($courseId)->lessons->first()->id;

            return $currentLessonId;
        }
    }
}

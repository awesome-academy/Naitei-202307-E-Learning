<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLessonRequest;
use App\Http\Requests\UpdateLessonRequest;
use App\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lessons = Lesson::with('course')->get();

        return $lessons;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $courseId = $request->query('course');
        
        return view('lessons.create', compact('courseId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLessonRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('video')) {
            $file = $request->file('video');
            $uploadResult = S3UploadController::uploadFileToS3($file, 'video');
            $filePath =  $uploadResult['filename'];
            $duration = $uploadResult['duration'];
        }

        $lesson = Lesson::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'video' => $filePath,
            'course_id' => $validated['course_id'],
            'duration' => $duration,
        ]);

        return redirect()->route('courses.show', ['course' => $validated['course_id']])
            ->with('success', __('Lesson created successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lesson = Lesson::with('course')->findOrFail($id);

        return $lesson;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lesson = Lesson::findOrFail($id);
        $courseId = $lesson->course_id;

        return view('lessons.edit', compact(['lesson', 'courseId']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLessonRequest $request, $id)
    {
        $validated = $request->validated();

        $lesson = Lesson::findOrFail($id);
        $courseId = $lesson->course_id;

        if ($request->hasFile('video')) {
            $file = $request->file('video');
            $uploadResult = S3UploadController::uploadFileToS3($file, 'video');
            $filePath = $uploadResult['filename'];
            $duration = $uploadResult['duration'];
        } else {
            $filePath = $lesson->video;
            $duration = $lesson->duration;
        }

        $lesson->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'video' => $filePath,
            'duration' => $duration,
        ]);

        return redirect()->route('courses.show', ['course' => $courseId])
            ->with('success', __('Lesson updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lesson = Lesson::findOrFail($id);
        $courseId = $lesson->course_id;

        $lesson->delete();

        return redirect()->route('courses.show', ['course' => $courseId])
            ->with('success', __('Lesson deleted successfully'));
    }
}

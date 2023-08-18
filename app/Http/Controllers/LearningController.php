<?php

namespace App\Http\Controllers;

use App\Course;
use App\Lesson;
use App\Progress;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LearningController extends Controller
{
    public function checkCompleted($course, $lesson)
    {
        $completed = false;
        $user_id = auth()->user()->id;
        $lesson_id_before = Lesson::where('course_id', $course->id)
            ->where('id', '<', $lesson->id)
            ->orderBy('id', 'desc')
            ->first();

        if ($course->lessons->first()->id !== $lesson->id) {
            $completed = Progress::where([
                'user_id' => $user_id,
                'lesson_id' => $lesson_id_before->id,
                'completed' => true,
            ])->exists();
        }

        return $completed;
    }

    public function show($id)
    {
        $lesson = Lesson::select('id', 'course_id', 'title', 'description', 'video', 'duration')->find($id);
        $course = Course::find($lesson->course_id);
        $teacher = User::select('id', 'name', 'avatar')->find($course->teacher_id);
        $user_id = Auth::user()->id;
        if (!$lesson) {
            return redirect()->back()->with('error', __('Lesson not found'));
        }

        //check completed
        $completed = $this->checkCompleted($course, $lesson);
        if (!$completed && $course->lessons->first()->id !== $lesson->id) {
            return redirect()->back()->with('error', __('You must complete the previous lesson'));
        }

        $learningProgressing = Progress::where([
            'user_id' => $user_id,
            'lesson_id' => $lesson->id,
            'completed' => false,
        ])->orderBy('created_at', 'asc')->first();

        if ($learningProgressing) {
            $start_lesson = Lesson::find($learningProgressing->lesson_id);
        } else {
            $start_lesson = $lesson;
        }

        $progress = Progress::where([
            'user_id' => $user_id,
            'lesson_id' => $start_lesson->id,
        ])->first();

        if (!$progress) {
            $start_learning = Progress::create([
                'user_id' => $user_id,
                'lesson_id' => $start_lesson->id,
                'completed' => false,
                'progress' => config('constant.progress.start_learning')
            ]);
        }

        $total = $this->statisticLearing($course->id);

        return view('learning.show', compact('course', 'start_lesson', 'teacher', 'total', 'progress'));
    }

    public function saveProgress($id)
    {
        $user_id = Auth::user()->id;
        $lesson = Lesson::find($id);

        $progress = Progress::where([
            'user_id' => $user_id,
            'lesson_id' => $id,
        ])->first();

        if ($progress !== null) {
            $progress->completed = true;
            $progress->progress = $lesson->duration;
            $progress->save();
        } else {
            $progress = Progress::create([
                'user_id' => $user_id,
                'lesson_id' => $id,
                'completed' => true,
                'progress' => $lesson->duration,
            ]);
        }

        $course_id = Lesson::find($id)->course_id;
        $course = Course::find($course_id);
        $lesson_id_next = Lesson::where('course_id', $course->id)->where('id', '>', $id)->orderBy('id', 'asc')->first();

        $id = $lesson_id_next->id ?? $id;
        return response()->json([
            'success' => true,
            'message' => __('Completed'),
            'id' => $id,
        ]);
    }

    public function statisticLearing($course_id)
    {
        $total_lesson = Lesson::where('course_id', $course_id)->count();
        $completedCount = Progress::where('completed', true)
            ->where('user_id', auth()->user()->id)
            ->whereIn('lesson_id', function ($query) use ($course_id) {
                $query->select('id')
                    ->from('lessons')
                    ->where('course_id', $course_id);
            })
            ->count();

        $total =  [
            'total_lesson' => $total_lesson,
            'total_completed' => $completedCount,
            'percent' => round($completedCount / $total_lesson * 100),
            'rate' => $completedCount . '/' . $total_lesson,
        ];

        return $total;
    }

    public function updateProgress(Request $request, $id)
    {
        $user_id = Auth::user()->id;
        $lesson_id = $id;
        $currentTime = $request->input('currentTime');

        $progress = Progress::where([
            'user_id' => $user_id,
            'lesson_id' => $lesson_id,
        ])->first();

        if ($progress === null) {
            $progress = Progress::create([
                'user_id' => $user_id,
                'lesson_id' => $lesson_id,
                'completed' => false,
                'progress' => $currentTime,
            ]);
        } elseif ($progress->progress < $currentTime) {
            $progress->progress = $currentTime;
            $progress->save();
        }

        return response()->json([
            'success' => true,
            'message' => __('Progress updated'),
            'progress' => $progress
        ]);
    }
}

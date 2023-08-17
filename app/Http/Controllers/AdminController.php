<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function showTeachers()
    {
        $perPage = config('constant.pagination.per_page_table');
        $statusOrder = [
            config('constant.status.pending'),
            config('constant.status.active'),
            config('constant.status.inactive'),
            config('constant.status.reject'),
        ];
        $teachers = User::where('role', 'teacher')
            ->orderByRaw("FIELD(status, '" . implode("', '", $statusOrder) . "')")
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        return view('admin.teachers', compact('teachers'));
    }

    public function showUsers()
    {
        return view('admin.users');
    }

    public function showCategories()
    {
        return view('admin.categories');
    }

    public function updateTeacherStatus(Request $request, $id)
    {
        $statusArr = config('constant.status');
        $status = $request->status;

        if (!in_array($status, $statusArr)) {
            return redirect()->route('admin.teachers')
                ->with('error', __('Status is invalid'));
        }

        $teacher = User::findOrFail($id);
        $teacher->status = $status;
        $teacher->save();

        return redirect()->route('admin.teachers')
            ->with('success', __('Status updated successfully'));
    }
}

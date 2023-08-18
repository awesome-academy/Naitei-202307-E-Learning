<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show()
    {
        $user = auth()->user();

        return view('auth.profile', compact('user'));
    }

    public function update(UpdateUserRequest $request)
    {
        $validated = $request->validated();

        $user = auth()->user();

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $uploadResult = S3UploadController::uploadFileToS3($file, 'avatar');
            $filePath = $uploadResult['filename'];
        } else {
            $filePath = $user->getOriginal('avatar');
        }

        $user->update([
            'name' => $validated['name'],
            'gender' => $validated['gender'],
            'phone_number' => $validated['phone_number'],
            'dob' => $validated['dob'],
            'avatar' => $filePath,
        ]);

        return redirect()->route('profile.show')->with('success', __('Profile updated successfully!'));
    }
}

<?php

use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('language/{lang}', [LanguageController::class, 'changeLanguage'])->name('locale');

Route::middleware('check.teacher')->group(function () {
    Route::resource('/courses', 'CourseController')->only(['create', 'store', 'destroy']);
});

Route::middleware('check.author')->group(function () {
    Route::resource('/courses', 'CourseController')->only(['edit', 'update']);
    Route::resource('/lessons', 'LessonController')->shallow();
});

Route::resource('/courses', 'CourseController')->only('index');

Route::get('/courses/{course}', 'CourseController@show')->name('courses.show');

Route::get('content/{type}/{fileName}', 'S3UploadController@showContent')->name('content.show');

Route::get('/learning/{course}', 'LearningController@show')->name('learning.show');

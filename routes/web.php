<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\PeriodController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PreceptorController;
use App\Http\Controllers\QualificationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('role', RoleController::class)->names('role');
    Route::resource('permission', PermissionController::class)->names('permission');
    Route::resource('student', StudentController::class)->names('student');
    Route::resource('teacher', TeacherController::class)->names('teacher');
    Route::resource('preceptor', PreceptorController::class)->names('preceptor');
    // Route::resource('admin', AdminController::class)->names('admin');
    Route::resource('course', CourseController::class)->names('course');
    Route::resource('period', PeriodController::class)->names('period');
    Route::resource('qualification', QualificationController::class)->names('qualification');
});

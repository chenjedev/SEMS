<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\MarkController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SchoolClassController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ClassTeacherController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/classes', [SchoolClassController::class, 'index'])->name('classes.index');
    Route::get('/students', [StudentController::class, 'index'])->name('students.index');
    Route::get('/classes/create', [SchoolClassController::class, 'create'])->name('classes.create');
    Route::post('/classes', [SchoolClassController::class, 'store'])->name('classes.store');
    Route::get('/classes/{id}/edit', [SchoolClassController::class, 'edit'])->name('classes.edit');
    Route::put('/classes/{id}', [SchoolClassController::class, 'update'])->name('classes.update');
    Route::delete('/classes/{id}', [SchoolClassController::class, 'destroy'])->name('classes.destroy');

    Route::get('/subjects', [SubjectController::class, 'index'])->name('subjects.index');
    Route::post('/subjects', [SubjectController::class, 'store'])->name('subjects.store');

    Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers.index');
    Route::post('/teachers', [TeacherController::class, 'store'])->name('teachers.store');

    
    Route::get('/admin', [AssignmentController::class, 'create'])->name('admin.assignsubjects');
    Route::post('/admin', [AssignmentController::class, 'store'])->name('admin.store');
    Route::get('/my-subjects', [AssignmentController::class, 'view'])->name('teachers.assignedsubject');
    
    Route::get('/students' , [StudentController::class, 'index'])->name('students.index');
    Route::get('/students/create' , [StudentController::class, 'create'])->name('students.create');
    Route::post('/students', [StudentController::class, 'store'])->name('students.store');

    Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');

    Route::get('/teachers/{subject_id}/{class_id}', [MarkController::class, 'addMarks'])->name('teachers.addmarks');
    Route::get('/marks/create' , [MarkController::class, 'create'])->name('marks.create');
    Route::post('/marks/store', [MarkController::class, 'store'])->name('marks.store');
    Route::get('/marks/list' , [MarkController::class, 'index'])->name('marks.index');

    Route::get('/class-performance/{id}', [ClassTeacherController::class, 'showPerformance'])
    ->name('class.performance');
     Route::post('/class/{id}/submit-to-admin', [ClassTeacherController::class, 'submitToAdmin'])
    ->name('class.submit_to_admin');

    Route::get('/admin/submitted-results', [AdminController::class, 'viewSubmittedResults'])->name('admin.results.index');
Route::get('/admin/review/{class_id}', [AdminController::class, 'reviewClassMarks'])->name('admin.results.review');
Route::post('/admin/approve/{class_id}', [AdminController::class, 'approveResults'])->name('admin.results.approve');
Route::post('/admin/reject/{class_id}', [AdminController::class, 'rejectResults'])->name('admin.results.reject');

});

require __DIR__.'/auth.php';

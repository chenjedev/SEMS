<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use App\Models\User;
use App\Models\Subject;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function create(){
        $teachers = User::where('role', 'teacher')->get();
        $subjects = Subject::all();
        $classes = SchoolClass::all();

        return view('admin.assignsubjects', compact('teachers', 'subjects', 'classes'));

    }

    public function view(){
        return view('teachers.assignedsubject');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'subject_id' => 'required|exists:subjects,id',
            'school_class_id' => 'required|exists:school_classes,id',

        ]);

        $teacher = User::findOrFail($validated['user_id']);

        $teacher->subjects()->attach($validated['subject_id'], [
            'school_class_id' => $validated['school_class_id'],
        ]);

        return redirect()->route('admin.assignsubjects');
    }

    public function teachers() {
        $teachers = User::where('role', 'teacher')->with(['subjects.pivot.schoolClass'])->get();

        return view('admin.assignsubjects', compact('teachers'));
    }
}

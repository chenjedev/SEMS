<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\User;
use App\Models\SchoolClass;
use Illuminate\Http\Request;


class StudentController extends Controller
{
    public function index(Request $request){
        if($request->has('class_id')) {
             $classId = $request->query('class_id');
             $myclass = SchoolClass::findOrFail($classId);
             $students = Student::where('class_id', $classId)->get();
        } 

        else 

        {

        $myclass = SchoolClass::where('teacher_id', Auth::id())->first();

        if(!$myclass) {
            return redirect()->back()->with('error', 'you dont have class');
        }

        $students = Student::where('class_id', $myclass->id)->get();
        }

        return view('students.index', compact('myclass', 'students'));
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|max:255',

            'gender' => 'required|in:Male,Female',
            'class_id' => 'required|exists:school_classes,id'
        ]);

        Student::create($validated);

        return redirect()->back();
    }

    public function create(){

        $myclass = auth()->user()->managedClass;

        return view('students.create', compact('myclass'));
    }
}

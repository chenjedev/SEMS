<?php

namespace App\Http\Controllers;
use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\User;
use App\Models\Subject;
use App\Models\Mark;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $totalStudents = Student::count();
        $totalTeachers = User::where('role', 'teacher')->count();
        $totalSubjects = Subject::count();
        $totalClasses = SchoolClass::count();
        $maleTeachers = User::where('role', 'teacher')->where('gender', 'male')->count();
        $femaleTeachers = User::where('role', 'teacher')->where('gender', 'female')->count();
        $maleStudents = Student::where('gender', 'male')->count();
        $femaleStudents = Student::where('gender', 'female')->count();

        return view('dashboard', compact(
            'totalStudents', 
            'totalTeachers',
            'totalSubjects',
            'totalClasses',
            'femaleTeachers',
            'maleTeachers',
            'maleStudents',
            'femaleStudents'
        ));
    }

 
   public function viewSubmittedResults() {
    // Vuta madarasa yote ambayo yameshatoka kwenye hali ya 'pending'
    $submittedClasses = SchoolClass::whereIn('result_status', ['submitted', 'approved', 'rejected'])->get();
    
    return view('admin.resultaproval', compact('submittedClasses'));
}



public function reviewClassMarks($class_id) {
    $class = SchoolClass::findOrFail($class_id);
    

    $students = $class->students; 
    
   
    $subjects = Subject::all(); 


    $all_marks = \App\Models\Mark::whereIn('student_id', $students->pluck('id'))
                ->get()
                ->groupBy('student_id');

   
    return view('admin.review_performance', compact('class', 'students', 'subjects', 'all_marks'));
}


public function approveResults($id)
{
    try {
        $class = SchoolClass::findOrFail($id);
        
        // 1. Tumia save() badala ya update() ili uone kama kuna error
        $class->result_status = 'approved';
        $class->save();

        $fullClassName = strtoupper($class->class_name . ' ' . $class->stream);

        // 2. Badala ya 'route', tumia 'action' ili uwe na uhakika inaenda kwenye function sahihi
        return redirect()->action([AdminController::class, 'viewSubmittedResults'])
            ->with('success', "RESULTS FOR - {$fullClassName} - HAVE BEEN OFFICIALLY APPROVED!");

    } catch (\Exception $e) {
        // Kama kuna error yoyote (mfano: database connection), itakuambia hapa
        return redirect()->back()->with('error', "Database Error: " . $e->getMessage());
    }
}


    public function rejectResults($class_id)
{
    $class = SchoolClass::findOrFail($class_id);
    
    // Logic ya kubadili status kwenda 'rejected' au 'draft'
    $class->update(['result_status' => 'rejected']);

    return redirect()->route('admin.results.index')
        ->with('error', "RESULTS FOR " . strtoupper($class->class_name) . " REJECTED AND SENT BACK TO TEACHER.");
}
}
<?php

namespace App\Http\Controllers;
use App\Models\SchoolClass;
use App\Models\Mark;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;

class ClassTeacherController extends Controller
{
   

public function showPerformance($class_id)
{
    $class = SchoolClass::with(['subjects', 'students'])->findOrFail($class_id);
    $subjects = $class->subjects;
    $students = $class->students;

    $all_marks = \App\Models\Mark::where('class_id', $class_id)
                    ->get()
                    ->groupBy('student_id');


    $subjectCounts = \App\Models\Mark::where('class_id', $class_id)
                    ->get()
                    ->groupBy('subject_id')
                    ->map->count();


    $totalExpectedMarks = $students->count() * $subjects->count();
    $actualMarksCount = \App\Models\Mark::where('class_id', $class_id)->count();
    $isComplete = ($totalExpectedMarks > 0 && $actualMarksCount >= $totalExpectedMarks);

    
    return view('classteacher.performance', compact(
        'class', 'subjects', 'students', 'all_marks', 
        'isComplete', 'actualMarksCount', 'totalExpectedMarks',
        'subjectCounts' 
    ));
}

  public function submitToAdmin($id)
{
    $class = SchoolClass::findOrFail($id);

   
    $subjectsCount = $class->subjects->count();
    $studentsCount = $class->students->count();
    $expected = $subjectsCount * $studentsCount;
    $actual = \App\Models\Mark::where('class_id', $id)->count();

    if ($actual < $expected) {
        return back()->with('error', 'Huwezi kutuma! Kuna marks bado hazijajazwa.');
    }

  
    $class->result_status = 'submitted';
    $class->save();

  
    return back()->with('success', 'Hongera! Matokeo ya ' . $class->name . ' yameshatumwa kwa Admin kitalamu.');
}
}

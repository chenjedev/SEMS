<?php

namespace App\Http\Controllers;
use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\User;
use App\Models\Subject;
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
}

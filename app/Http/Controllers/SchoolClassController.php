<?php

namespace App\Http\Controllers;
use App\Models\SchoolClass;
use App\Models\Student; 
use App\Models\User;
use Illuminate\Http\Request;

class SchoolClassController extends Controller
{
    public function index()
    {
        $classes = SchoolClass::all();
        return view('classes.index', compact('classes'));
    }
    
    public function create()
{
    return view('classes.create'); // Hii inafungua form tupu
}
  
    public function store(Request $request)
    {
        $validated = $request->validate([
            'class_name' => 'required|string|max:255',
            'stream' => 'required|string|max:255',
        ]);

        SchoolClass::create($validated);

        return redirect()->route('classes.index')->with('success', 'Class created successfully.');
    }

    public function edit($id){
        $classes = SchoolClass::findOrFail($id);
        $teachers = User::where('role', 'teacher')->whereDoesntHave('classTeacher')->orWhere('id', $classes->teacher_id)->get();

        return view('classes.edit', compact('classes', 'teachers'));

    }

    public function update(Request $request, $id){
        $classes = SchoolClass::findOrFail($id);
        
        $isAlreadyAssigned = \App\Models\SchoolClass::where('teacher_id' , $request->teacher_id)->where('id', '!=', $id)->exists();
        if($isAlreadyAssigned){
            return back()->with('error', 'teacher has class');
        }

        $classes->teacher_id = $request->teacher_id;
        $classes->save();

        return redirect()->route('classes.index');
    }

    public function destroy($id){
        $classes = SchoolClass::findOrFail($id);

        $classes->delete();

        return redirect()->route('classes.index');
    }

    public function viewStudents($id){
         $class = SchoolClass::findOrFail($id);
         $students = $class->students;
         
         return view('students.index', compact('class', 'students'));
    }

}

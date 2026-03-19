<?php

namespace App\Http\Controllers;
use App\Models\Student;
use App\Models\Mark;
use App\Models\Subject;
use App\Models\SchoolClass;
use Illuminate\Http\Request;

class MarkController extends Controller
{
     public function addMarks($subject_id, $class_id){
        $subject = Subject::findOrFail($subject_id);
        $class = SchoolClass::findOrFail($class_id);
        $students = Student::where('class_id', $class_id)->get();
        
        return view('teachers.addmarks', compact('subject', 'students', 'class_id', 'class'));
     }

     public function store(Request $request){


        $validated = $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'class_id' => 'required|exists:school_classes, id',
            'marks' => 'required|array',
        ]);

      
       

        $subject_id = $validated['subject_id'];
        $class_id = $validated['class_id'];
       
        try {
        foreach($validated['marks'] as $student_id => $scores) 
          {
            $t1 = $scores['test_1'] ?? 0;
            $t2 = $scores['test_2'] ?? 0;
            $terminal = $scores['terminal'] ?? 0;

            $test_avg = ($t1 + $t2) / 2;
            $ca = ($test_avg / 100 ) * 40;
            $final = ($terminal / 100) * 60;
            $total = $ca + $final ;

            $grade = $this->calculateGrade($total);
            $remarks = $this->getRemarks($grade);

            Mark::updateOrCreate(
            [   'student_id' => $student_id,
                'subject_id' => $validated['subject_id'],
            ],
            [  'class_id' => $validated['class_id'],
               'test_1' => $t1, 
               'test_2' => $t2,
               'terminal' => $terminal,
               'ca'  => $ca,
               'final' => $final,
               'total' => $total,
               'grade' => $grade,
               'remarks' => $remarks,
            ]
            );
           
        }

        return redirect()->back();

        }

        
         catch (\Exception $e ) {
         dd("ERROR HAPPENS: " . $e->getMessage());
        }

     }
     

     private function calculateGrade($scores) {
        if ($scores >= 75)  return 'A';
        if ($scores >= 65)  return 'B';
        if ($scores >= 45)  return 'C';
        if ($scores >= 30)  return 'D';
        return 'F';
     }

     private function getRemarks($grade) {
        $map = ['A' =>'Excallent', 'B' => 'Very Good' , 'C' => 'Good', 'D' => 'Satisfactory', 'F' => 'Fail'];
        return $map[$grade] ?? '-';
     }
}

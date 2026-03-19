<?php

namespace App\Http\Controllers;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index(){
        $subjects = Subject::all();
        return view('subjects.index', compact('subjects'));
    }

    public function store(Request $request){
       $validated = $request->validate([
        'name' => 'required|string',
        'code' => 'string'
       ]);

       Subject::create($validated);
        return redirect()->route('subjects.index')->with('succes', "Subject Added Succesfully");
    }
}

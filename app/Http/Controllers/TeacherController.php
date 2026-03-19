<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index(){
        $teachers = User::where('role', 'teacher')->get();
        return view('teachers.index', compact('teachers'));
    }

    public function store(Request $request){
        $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|unique:users,email',
        'phone' => 'required|string|max:15|min:0',
        'gender' => 'required|string',

        ]);

        $validated['password'] = Hash::make('12345678');
        $validated['role'] = 'teacher';

        User::create($validated);
        return redirect()->route('teachers.index');
    }
}

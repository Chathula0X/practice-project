<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;

class StudentContoller extends Controller
{
    public function index(){
       $students = Student::all();
        return view('Student.index', compact('students'));
    }

    public function create(){
        return view('Student.create');
    }

    public function store(Request $request){
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'age' => 'required|integer|min:1|max:120',
            'gender' => 'required|string|in:male,female,other',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        //method 1
        $student = new Student();
        $student->name = $request->name;
        $student->email = $request->email;
        $student->age = $request->age;
        $student->gender = $request->gender;
        $student->save();

        //method 2
        // $student = Student::create($request->all());

        return redirect()->route('student.index')->with('success', 'Student created successfully!');
    }

    public function edit($student_id){
        $student = Student::where('id', $student_id)->first();
        return view('Student.edit', compact('student'));
    }

    public function update(Request $request, $student_id){
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $student_id,
            'age' => 'required|integer|min:1|max:120',
            'gender' => 'required|string|in:male,female,other',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $student = Student::find($student_id);
        $student->name = $request->name;
        $student->email = $request->email;
        $student->age = $request->age;
        $student->gender = $request->gender;
        $student->save();

        return redirect()->route('student.index')->with('success', 'Student updated successfully!');
    }

    public function delete($student_id){
        $student = Student::find($student_id);
        $student->delete();
        return redirect()->route('student.index')->with('success', 'Student deleted successfully!');
    }
}

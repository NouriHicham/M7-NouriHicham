<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\student;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return response()->json(['students' => $students], 200);
    }

    public function show($id){
        $student = Student::find($id);
        if($student){
            return response()->json(['student' => $student], 200);
        }else {
            return response()->json(['error' => 'Student not found'], 404);
        }
    }

    public function store(Request $request){
        $student = Student::create($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:student',
            'phone' => 'required|digits:10',
            'address' => 'required|max:255',
        ]);
        return response()->json(['student' => $student], 201);
    }

    public function update(Request $request, $id)
    {
        $student = Student::find($id);
        if($student){
            $student->update($request->all(), [
                'name' => 'required|max:255',
                'email' => 'required|email|unique:student,email,'.$student->id,
                'phone' => 'required|digits:10',
                'address' => 'required|max:255',
            ]);
            return response()->json(['student' => $student], 200);
        } else {
            return response()->json(['error' => 'Student not found'], 404);
        }
    }

    public function destroy($id)
    {
        $student = Student::find($id);
        if($student){
            $student->delete();
            return response()->json(['message' => 'Student deleted successfully'], 204);
        } else {
            return response()->json(['error' => 'Student not found'], 404);
        }
    }

}

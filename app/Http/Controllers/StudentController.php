<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function getAllStudents() {
        $students = Student::get()->toJson();

        return response($students, 200);
    }

    public function getStudent($id) {
        if (Student::where('id', $id)->exists()) {
            $student = Student::where('id', $id)->get()->toJson();
            
            return response($student, 200);
        } else {
            return response()->json(["message" => "Student not found."], 404);
        }
    }

    public function createStudent(Request $request) {
        $student = new Student;
        $student->student_code  = $request->student_code;
        $student->name          = $request->name;
        $student->email         = $request->email;
        $student->phone         = $request->phone;
        $student->birth_date    = $request->birth_date;
        $student->address       = $request->address;
        $student->postal_code   = $request->postal_code;
        $student->locality      = $request->locality;
        $student->district      = $request->district;
        $student->country       = $request->country;

        $student->save();

        return response()->json(["message" => "Student created successfully!"], 201);
    }

    public function updateStudent(Request $request, $id) {
        if (Student::where('id', $id)->exists()) {

            $student = Student::find($id);

            $student->student_code  = is_null($request->student_code)   ? $student->student_code    : $request->student_code;
            $student->name          = is_null($request->name)           ? $student->name            : $request->name;
            $student->email         = is_null($request->email)          ? $student->email           : $request->email;
            $student->phone         = is_null($request->phone)          ? $student->phone           : $request->phone;
            $student->birth_date    = is_null($request->birth_date)     ? $student->birth_date      : $request->birth_date;
            $student->address       = is_null($request->address)        ? $student->address         : $request->address;
            $student->postal_code   = is_null($request->postal_code)    ? $student->postal_code     : $request->postal_code;
            $student->locality      = is_null($request->locality)       ? $student->locality        : $request->locality;
            $student->district      = is_null($request->district)       ? $student->district        : $request->district;
            $student->country       = is_null($request->country)        ? $student->country         : $request->country;

            $student->save();
    
            return response()->json(["message" => "Student updated successfully!"], 200);
        } else {
            return response()->json(["message" => "Student not found."], 404);
        }
    }

    public function deleteStudent($id) {
        if (Student::where('id', $id)->exists()) {

            $student = Student::find($id);

            $student->delete();

            return response()->json(["message" => "Student deleted successfully!"], 200);
        } else {
            return response()->json(["message" => "Student not found."], 404);
        }
    }
}

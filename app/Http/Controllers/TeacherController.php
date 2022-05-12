<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Teacher;

class TeacherController extends Controller
{
    public function getAllTeachers() {
        $teachers = Teacher::get()->toJson();

        return response($teachers, 200);
    }

    public function getTeacher($id) {
        if (Teacher::where('id', $id)->exists()) {
            $teacher = Teacher::where('id', $id)->get()->toJson();
            
            return response($teacher, 200);
        } else {
            return response()->json(["message" => "Teacher not found."], 404);
        }
    }

    public function createTeacher(Request $request) {

        $rules = [
            'teacher_code'  => 'required|max:20|unique:teachers',
            'name'          => 'required|max:255',
            'email'         => 'required|max:255|email:rfc|unique:teachers',
            'phone'         => 'required|max:20',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $teacher = new Teacher;
        $teacher->teacher_code  = $request->teacher_code;
        $teacher->name          = $request->name;
        $teacher->email         = $request->email;
        $teacher->phone         = $request->phone;

        $teacher->save();

        return response()->json(["message" => "Teacher created successfully!"], 201);

    }

    public function updateTeacher(Request $request, $id) {
        if (Teacher::where('id', $id)->exists()) {

            $teacher = Teacher::find($id);

            $teacher->teacher_code  = is_null($request->teacher_code)   ? $teacher->teacher_code    : $request->teacher_code;
            $teacher->name          = is_null($request->name)           ? $teacher->name            : $request->name;
            $teacher->email         = is_null($request->email)          ? $teacher->email           : $request->email;
            $teacher->phone         = is_null($request->phone)          ? $teacher->phone           : $request->phone;
            $teacher->save();
    
            return response()->json(["message" => "Teacher updated successfully!"], 200);
        } else {
            return response()->json(["message" => "Teacher not found."], 404);
        }
    }

    public function deleteTeacher($id) {
        if (Teacher::where('id', $id)->exists()) {

            $teacher = Teacher::find($id);

            $teacher->delete();

            return response()->json(["message" => "Teacher deleted successfully!"], 200);
        } else {
            return response()->json(["message" => "Teacher not found."], 404);
        }
    }
}
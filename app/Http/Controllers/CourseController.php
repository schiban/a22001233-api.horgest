<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Course;

class CourseController extends Controller
{
    public function getAllCourses() {
        $courses = Course::get()->toJson();

        return response($courses, 200);
    }

    public function getCourse($id) {
        if (Course::where('id', $id)->exists()) {
            $course = Course::where('id', $id)->get()->toJson();
            
            return response($course, 200);
        } else {
            return response()->json(["message" => "Course not found."], 404);
        }
    }

    public function createCourse(Request $request) {

        $rules = [
            'course_code'   => 'required|max:20|unique:courses',
            'name'          => 'required|max:255',
            'total_ects'    => 'required|max:11|integer',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $course = new Course;
        $course->course_code    = $request->course_code;
        $course->name           = $request->name;
        $course->total_ects     = $request->total_ects;

        $course->save();

        return response()->json(["message" => "Course created successfully!"], 201);

    }

    public function updateCourse(Request $request, $id) {
        if (Course::where('id', $id)->exists()) {

            $course = Course::find($id);

            $course->course_code    = is_null($request->course_code)    ? $course->course_code    : $request->course_code;
            $course->name           = is_null($request->name)           ? $course->name           : $request->name;
            $course->total_ects     = is_null($request->total_ects)     ? $course->total_ects     : $request->total_ects;
            $course->save();
    
            return response()->json(["message" => "Course updated successfully!"], 200);
        } else {
            return response()->json(["message" => "Course not found."], 404);
        }
    }

    public function deleteCourse($id) {
        if (Course::where('id', $id)->exists()) {

            $course = Course::find($id);

            $course->delete();

            return response()->json(["message" => "Course deleted successfully!"], 200);
        } else {
            return response()->json(["message" => "Course not found."], 404);
        }
    }
}

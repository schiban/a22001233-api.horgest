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

    }

    public function createStudent(Request $request) {
  
    }

    public function updateStudent(Request $request, $id) {
        
    }

    public function deleteStudent($id) {
        
    }
}

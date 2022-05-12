<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Classe;

class ClasseController extends Controller
{
    public function getAllClasses() {
        $classes = Classe::get()->toJson();

        return response($classes, 200);
    }

    public function getClasse($id) {
        if (Classe::where('id', $id)->exists()) {
            $classe = Classe::where('id', $id)->get()->toJson();
            
            return response($classe, 200);
        } else {
            return response()->json(["message" => "Classe not found."], 404);
        }
    }

    public function createClasse(Request $request) {

        $rules = [
            'teacher_id'    => 'required|integer|exists:teachers,id',
            'course_id'     => 'required|integer|exists:courses,id'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $classe = new Classe;
        $classe->teacher_id    = $request->teacher_id;
        $classe->course_id     = $request->course_id;

        $classe->save();

        return response()->json(["message" => "Classe created successfully!"], 201);

    }

    public function updateClasse(Request $request, $id) {
        if (Classe::where('id', $id)->exists()) {

            $classe = Classe::find($id);

            $classe->teacher_id    = is_null($request->teacher_id)    ? $classe->teacher_id    : $request->teacher_id;
            $classe->course_id     = is_null($request->course_id)     ? $classe->course_id     : $request->course_id;
            $classe->save();
    
            return response()->json(["message" => "Classe updated successfully!"], 200);
        } else {
            return response()->json(["message" => "Classe not found."], 404);
        }
    }

    public function deleteClasse($id) {
        if (Classe::where('id', $id)->exists()) {

            $classe = Classe::find($id);

            $classe->delete();

            return response()->json(["message" => "Classe deleted successfully!"], 200);
        } else {
            return response()->json(["message" => "Classe not found."], 404);
        }
    }
}

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
|
|
| Route::middleware('auth:api')->get('/user', function (Request $request) {
|     return $request->user();
| });
*/

// Students
Route::get('students', 'App\Http\Controllers\StudentController@getAllStudents');
Route::get('students/{id}', 'App\Http\Controllers\StudentController@getStudent');
Route::post('students/', 'App\Http\Controllers\StudentController@createStudent');
Route::put('students/{id}', 'App\Http\Controllers\StudentController@updateStudent');
Route::delete('students/{id}', 'App\Http\Controllers\StudentController@deleteStudent');

// Teachers
Route::get('teachers', 'App\Http\Controllers\TeacherController@getAllTeachers');
Route::get('teachers/{id}', 'App\Http\Controllers\TeacherController@getTeacher');
Route::post('teachers/', 'App\Http\Controllers\TeacherController@createTeacher');
Route::put('teachers/{id}', 'App\Http\Controllers\TeacherController@updateTeacher');
Route::delete('teachers/{id}', 'App\Http\Controllers\TeacherController@deleteTeacher');

// Courses
Route::get('courses', 'App\Http\Controllers\CourseController@getAllCourses');
Route::get('courses/{id}', 'App\Http\Controllers\CourseController@getCourse');
Route::post('courses/', 'App\Http\Controllers\CourseController@createCourse');
Route::put('courses/{id}', 'App\Http\Controllers\CourseController@updateCourse');
Route::delete('courses/{id}', 'App\Http\Controllers\CourseController@deleteCourse');

// Classes
Route::get('classes', 'App\Http\Controllers\ClasseController@getAllClasses');
Route::get('classes/{id}', 'App\Http\Controllers\ClasseController@getClasse');
Route::post('classes/', 'App\Http\Controllers\ClasseController@createClasse');
Route::put('classes/{id}', 'App\Http\Controllers\ClasseController@updateClasse');
Route::delete('classes/{id}', 'App\Http\Controllers\ClasseController@deleteClasse');
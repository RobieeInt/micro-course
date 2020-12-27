<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ImageCourse;
use App\Course;
use Illuminate\Support\Facades\Validator;


class ImageCourseController extends Controller
{
    public function create(Request $request){
        $rules = [
            'image' => 'required|url',
            'course_id' => 'required|integer'
        ];

        $data = $request->all();

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'errror',
                'message' => $validator->errors()
            ], 400);
        }

        $courseId = $request->input('course_id');
        $course = Course::find($courseId);
            if (!$course) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Course gada'
                ], 404);
            }

            $imageCourse = ImageCourse::create($data);
            return response()->json([
                'message' => 'Sukses',
                'data' => $imageCourse
            ]);
    }

    public function destroy($id){
        $imageCourse = ImageCourse::find($id);
            if (!$imageCourse) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Image Course gada'
                ], 404);
            }

            $imageCourse->delete();
            return response()->json([
                'status' => 'Sukses',
                'message' => 'Deleted'
            ]);
    }
}

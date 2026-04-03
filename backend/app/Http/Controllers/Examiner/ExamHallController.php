<?php

namespace App\Http\Controllers\Examiner;

use App\Http\Controllers\Controller;
use App\Http\Requests\Examiner\StoreExamHall;
use App\Http\Requests\Examiner\UpdateExamHall;
use App\Models\ExamHall;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;


class ExamHallController extends Controller
{
    public function index()
    {

        try {

            $examHalls =  auth()->user()->exam_halls()->get();

            return response()->json([
                'status' => 'success',
                'message' => 'Exam Hall Fetched Successfully',
                'exam_halls' => $examHalls
            ], 200);
        } catch (\Exception $e) {

            Log::error('Something Went Wrong: ' . $e->getMessage());

            return response()->json([

                'status' => 'error',
                'message' => 'Something Went Wrong'


            ], 500);
        }
    }

    public function store(StoreExamHall $request)
    {

        try {

            do {

                $code = Str::random(8);
            } while (ExamHall::where('code', $code)->exists());


            auth()->user()->exam_halls()->create([
                'name' => $request->name,
                'code' => $code
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Exam Hall Added Successfully'
            ]);
        } catch (\Exception $e) {
            Log::error('Exam Hall Storing Error: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'message'  => 'something went wrong'
            ], 500);
        }
    }

    public function show($id)
    {

        try {

            $examHall = ExamHall::find($id);

            return response()->json([

                'status' => 'success',
                'message' => 'ExamHall Fetched Successfully',
                'exam_hall' => $examHall

            ], 200);
        } catch (\Exception $e) {

            Log::error('Something Went Wrong:- ' . $e->getMessage());

            return response()->json([

                'status' => 'success',
                'message' => 'Something Went Wrong',
            ]);
        }
    }

    public function update($id, UpdateExamHall $request)
    {

        try {

            $examHall = ExamHall::find($id);

            $examHall->update($request->validated());


            return response()->json([
                'status' => 'success',
                'message' => 'ExamHall Updated Successfully'
            ], 201);
        } catch (\Exception $e) {

            Log::error('Something Went Wrong: ' . $e->getMessage());

            return response()->json([
                'status' => 'error',
                'messsage' => 'Something Went Wrong'
            ], 500);
        }
    }
}

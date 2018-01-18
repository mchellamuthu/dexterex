<?php

namespace App\Http\Controllers\API\V1;

use App\Exam;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Student;
use App\ClassRoom;
class ExamController extends Controller
{

    public function __construct()
    {
      $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $this->validate($request,[
        'classroom'=>'required|exists:class_rooms,id'
      ]);
      $user = Auth::user();
      $classroom = ClassRoom::where(['id'=>$request->classroom,'user_id'=>$user->id])->firstOrFail();
      // $exam_data = $classroom->exams();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request,[
        'classroom'=>'required|exists:class_rooms,id',
        'title'=>'required|string',
        'max_mark'=>'required|integer|max:5',
        'min_mark'=>'required|integer|max:5',
      ]);

      $user = Auth::user();
      $classroom = ClassRoom::where(['id'=>$request->classroom,'user_id'=>$user->id])->firstOrFail();

      $exam  = Exam::create([
        'title'=>$request->title,
        'class_room_id'=>$request->clasroom,
        'pass_marks'=>$request->min_mark,
        'maximum_marks'=>$request->maximum_marks,
        'user_id'=>$user->id
      ]);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function show(Exam $exam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function edit(Exam $exam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exam $exam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exam $exam)
    {
        //
    }
}

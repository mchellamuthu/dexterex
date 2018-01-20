<?php

namespace App\Http\Controllers\API\V1;

use App\Exam;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Student;
use App\Subject;
use App\ClassRoom;
use Auth;
use App\Http\Resources\ExamResource;
use App\Http\Resources\ExamsCollection;
use App\Http\Resources\SubjectsCollection;
use App\SubjectPaper;

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
        $this->validate($request, [
        'classroom'=>'required|exists:class_rooms,id'
      ]);
        $user = Auth::user();
        $classroom = ClassRoom::where(['id'=>$request->classroom,'user_id'=>$user->id])->firstOrFail();
        $exams = $classroom->exams()->get();
        return new ExamsCollection($exams);
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
        $this->validate($request, [
        'classroom'=>'required|exists:class_rooms,id',
        'title'=>'required|string',
        'max_mark'=>'required|integer',
        'min_mark'=>'required|integer',
      ]);

        $user = Auth::user();
        $classroom = ClassRoom::where(['id'=>$request->classroom,'user_id'=>$user->id])->firstOrFail();
        //create exam
        $exam  = Exam::create([
        'title'=>$request->title,
        'class_room_id'=>$request->classroom,
        'pass_marks'=>$request->min_mark,
        'maximum_marks'=>$request->max_mark,
        'user_id'=>$user->id,
      ]);

        $exam_id = $exam->id;
        //create subjects under exam
        foreach ($request->subjects as $subject) {
            $subject_data = Subject::create([
            'class_room_id'=>$request->classroom,
            'user_id'=>$user->id,
            'exam_id'=>$exam_id,
            'name'=>$subject['name'],
            'code'=>$subject['code'],
            'maximum_marks'=>$subject['mark'],
          ]);
            $papers = $subject['papers'];
            $subject_id = $subject_data->id;
            if (count($papers) > 0) {
                foreach ($papers as $paper) {
                    SubjectPaper::create([
                'class_room_id'=>$request->classroom,
                'user_id'=>$user->id,
                'subject_id'=>$subject_id,
                'exam_id'=>$exam_id,
                'name'=>$paper['name'],
                'code'=>$paper['code'],
                'mark'=>$paper['mark'],
                'calc_mark'=>$paper['get_mark'],
              ]);
                }
            }
        }
        return new ExamResource($exam);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $this->validate($request, [
        'exam'=>'required|exists:exams,id',
        // 'exam'=>'required',

      ]);

        $user = Auth::user();
        // $classroom = ClassRoom::where(['id'=>$request->classroom,'user_id'=>$user->id])->firstOrFail();
        $exam = Exam::where(['id'=>$request->exam])->firstOrFail();
        if ($exam->subjects->count() > 0 ) {
          return new SubjectsCollection($exam->subjects()->get());
          }
          return response()->json(['msg'=>'No Subjects found!']);

    }

    public function exam(Request $request)
    {
        $this->validate($request, [
        'exam'=>'required|exists:exams,id',
        ]);
        $user = Auth::user();
        $exam = Exam::where(['id'=>$request->exam])->firstOrFail();
        return new ExamResource($exam);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
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

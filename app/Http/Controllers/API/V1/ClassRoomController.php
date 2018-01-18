<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ClassRoom;
use App\User;
use Auth;
use App\Http\Resources\ClassRoomsCollection;
use App\Http\Resources\ClassRoomResource;
use App\Http\Resources\StudentsCollection;
use App\Http\Resources\StudentResource;

class ClassRoomController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user  = Auth::user();
        $classrooms = $user->classrooms()->orderBy('created_at','asc')->get();
        return new ClassRoomsCollection($classrooms);
    }

    public function students(Request $request)
    {
      $this->validate($request, [
        'classroom'=>'required|exists:class_rooms,id'
      ]);
      $user = Auth::user();
      $classroom = ClassRoom::where(['id'=>$request->classroom,'user_id'=>$user->id])->firstOrFail();
      $students = $classroom->students()->orderBy('created_at','desc')->get();
      return new StudentsCollection($students);
    }
}

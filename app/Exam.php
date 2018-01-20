<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exam extends Model
{
  use Uuids;
  use SoftDeletes;
  public $incrementing = false;

  protected $guarded = [];

  public function classroom()
  {
    return $this->belongsTo(ClassRoom::class,'class_room_id','id');
  }
  public function subjects()
  {
    return $this->hasMany(Subject::class,'exam_id','id');
  }
}

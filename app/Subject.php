<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
  use Uuids;
  public $incrementing = false;
  protected $guarded = [];
  public function exam()
  {
    return $this->belongsTo(Exam::class,'exam_id','id');
  }
}

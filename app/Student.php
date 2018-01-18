<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
  use Uuids;
  public $incrementing = false;
  protected $guarded = [];

  public function classroom()
  {
    return $this->belongsToMany('App\ClassRoom','student_class_rooms')->withTimestamps();
  }
}

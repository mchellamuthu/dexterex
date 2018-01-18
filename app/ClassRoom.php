<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassRoom extends Model
{
    use Uuids;
    use SoftDeletes;
    public $incrementing = false;
    protected $fillable = ['user_id','institute_id','name','avatar','section'];

    public function user()
    {
      return $this->belongsTo(User::class);
    }
    public function students()
    {
      return $this->belongsToMany('App\Student','student_class_rooms')->withTimestamps();
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubjectPaper extends Model
{
    use Uuids;
    public $incrementing = false;
    protected $guarded = [];

    public function classroom()
    {
      return $this->belongsTo(ClassRoom::class);
    }
}

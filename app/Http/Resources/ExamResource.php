<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ExamResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
          '_id'=>$this->id,
          'title'=>$this->title,
          'maximum_mark'=>$this->maximum_marks,
          'pass_mark'=>$this->pass_marks,
          'classroom'=>$this->classroom->id,
        ];
    }
}

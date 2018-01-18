<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class StudentResource extends Resource
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
        'first_name'=>$this->first_name,
        'last_name'=>$this->last_name,
        'rollno'=>$this->rollno,
        'avatar'=>$this->avatar,
        'created_at'=>$this->created_at,
      ];
    }
}

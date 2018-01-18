<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ClassRoomResource extends Resource
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
          '_id'=>$this->name,
          'avatar'=>$this->avatar,
          'section'=>$this->section,
          'created_at'=>$this->created_at,
        ];

    }
}

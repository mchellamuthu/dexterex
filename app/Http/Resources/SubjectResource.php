<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class SubjectResource extends Resource
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
          'name'=>$this->name,
          'mark'=>$this->mark,
          'code'=>$this->code,
        ];
    }
}

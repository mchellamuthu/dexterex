<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class StudentsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
      return $this->collection->map(function($item){
        return [
          '_id'=>$item->id,
          'first_name'=>$item->first_name,
          'last_name'=>$item->last_name,
          'rollno'=>$item->rollno,
          'avatar'=>$item->avatar,
          'created_at'=>$item->created_at,
        ];
      });
    }
}

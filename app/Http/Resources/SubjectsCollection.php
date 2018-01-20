<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SubjectsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->transform(function($item){
          return [
            '_id'=>$item->id,
            'name'=>$item->name,
            'mark'=>$item->maximum_marks,
            'code'=>$item->code,
          ];
        });
    }
}

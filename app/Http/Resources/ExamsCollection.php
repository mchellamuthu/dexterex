<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ExamsCollection extends ResourceCollection
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
            'title'=>$item->title,
            'maximum_mark'=>$item->maximum_marks,
            'pass_mark'=>$item->pass_marks,
          ];
        });
    }
}

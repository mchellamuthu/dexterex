<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ClassRoomsCollection extends ResourceCollection
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
            'name'=>$item->name,
            'avatar'=>$item->avatar,
            'section'=>$item->section,
            'created_at'=>$item->created_at,
          ];
        });
    }
}

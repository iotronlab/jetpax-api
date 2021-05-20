<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FilterOptionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id'                    =>  $this->id,
            'admin_name'            =>  $this->admin_name,
            'filter_code'           =>  $this->filter_code,
            'order'                 =>  $this->order,
        ];
    }
}

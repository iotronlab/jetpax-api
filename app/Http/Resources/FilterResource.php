<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FilterResource extends JsonResource
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
            'id'                => $this->id,
            'code'              => $this->code,
            'admin_name'        => $this->admin_name,
            'order'             => $this->order,
            'options'           => FilterOptionResource::collection($this->options)
        ];
    }
}

<?php

namespace App\Http\Resources\Creator;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
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
            'name'              => $this->name,
            'desc'              => $this->desc,
            'rate'            => $this->pivot->rate,
        ];
    }
}

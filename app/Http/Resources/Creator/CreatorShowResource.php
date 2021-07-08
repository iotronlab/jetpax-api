<?php

namespace App\Http\Resources\Creator;

use Illuminate\Http\Resources\Json\JsonResource;

class CreatorShowResource extends CreatorIndexResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return array_merge(parent::toArray($request), [
            'services'   => $this->whenLoaded('services'),
        ]);
    }
}

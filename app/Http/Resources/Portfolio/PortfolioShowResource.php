<?php

namespace App\Http\Resources\Portfolio;

use App\Http\Resources\Post\PostIndexResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PortfolioShowResource extends PortfolioIndexResource
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
            'posts'  => PostIndexResource::collection($this->whenLoaded('posts'))
        ]);
    }
}

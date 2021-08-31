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
            'client_brief'              => $this->client_brief,
            'client_location' => $this->client_location,
            'tools'                     => $this->tools,
            'external_url' => $this->external_url,
            'services' => $this->services,
            'project_description'       => $this->project_description,
            'meta'              => $this->meta,
            'posts'  => PostIndexResource::collection($this->whenLoaded('posts'))
        ]);
    }
}

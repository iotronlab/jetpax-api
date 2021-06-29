<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PortfolioResource extends JsonResource
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
            'id'                      => $this->id,
            'name'                      => $this->name,
            'client_brief'              => $this->client_brief,
            'project_description'       => $this->project_description,

            'tools'                     => $this->tools,
            'images'                    => $this->whenLoaded('attachment'),
            'posts'                    => $this->whenLoaded('posts')
        ];
    }
}

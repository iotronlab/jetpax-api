<?php

namespace App\Http\Resources\Portfolio;

use Illuminate\Http\Resources\Json\JsonResource;

class PortfolioIndexResource extends JsonResource
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
            'url'                      => $this->url,
            'name'                      => $this->name,
            'client_brief'              => $this->client_brief,
            'project_description'       => $this->project_description,
            'meta'              => $this->meta,
            'tools'                     => $this->tools,
            'images'                    => $this->whenLoaded('attachment'),
        ];
    }
}

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
            'name'                      => $this->name,
            'client_brief'              => $this->client_brief,
            'project_description'       => $this->project_description,
            'typography'                => $this->typography,
            'palette'                   => $this->palette,
            'tools'                     => $this->tools,
            'images'                    => $this->load('attachment')
        ];
    }
}

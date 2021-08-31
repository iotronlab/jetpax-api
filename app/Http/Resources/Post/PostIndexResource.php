<?php

namespace App\Http\Resources\Post;

use Illuminate\Http\Resources\Json\JsonResource;

class PostIndexResource extends JsonResource
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
            'id'                       => $this->id,
            'name'                     => $this->name,
            'content'                  => $this->content,
            'external_url'             => $this->external_url,
            'video_url'                => $this->video_url,
            'meta'                     => $this->meta,
            'images'                   => $this->whenLoaded('attachment'),
        ];
    }
}

<?php

namespace App\Http\Resources\Creator;

use Illuminate\Http\Resources\Json\JsonResource;

class CreatorIndexResource extends JsonResource
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
            // 'id'                => $this->id,
            'name'              => $this->name,
            'url'              => $this->url,
            // 'email'             => $this->email,
            // 'contact'           => $this->contact,
            'gender'            => $this->gender,
            'max_follower'      => $this->max_followers,
            'short_bio'      => $this->short_bio,
            'long_bio'      => $this->long_bio,
            'languages'          => $this->languages,
            'categories'          => $this->categories,
            'socials'           => $this->whenLoaded('socials'),
            'display_image' => $this->display_image,
            'cover_image' => $this->cover_image,
        ];
    }
}

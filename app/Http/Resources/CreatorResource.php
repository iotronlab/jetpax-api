<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CreatorResource extends JsonResource
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
            'id'                => $this->id,
            'name'              => $this->name,
            'email'             => $this->email,
            'gender'            => $this->gender,
            'max_follower'      => $this->max_followers,
            'language'          => $this->languages,
            'socials'          => $this->socials,
            'category'          => $this->categories,
        ];
    }
}

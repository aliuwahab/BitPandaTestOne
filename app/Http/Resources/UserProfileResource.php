<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserProfileResource extends JsonResource
{
    /**
     * Transform the resource we return to client. We can format the data any how without exposing how the backend structure looks like.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'status' => (bool) $this->active,
            'fullName' => $this->profile ? $this->profile->last_name .' '.$this->profile->last_name : null,
            'nationality' => $this->profile && $this->profile->nationality ? $this->profile->nationality->name: null,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

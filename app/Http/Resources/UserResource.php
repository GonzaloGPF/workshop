<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class UserResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'nick' => $this->nick,
            'email' => $this->email,
            'role_id' => $this->role_id,
            'role' => new RoleResource($this->whenLoaded('role')),
            'created_at' => $this->created_at->toDateString(),
            'isAdmin' => (boolean) $this->isAdmin()
        ];
    }
}

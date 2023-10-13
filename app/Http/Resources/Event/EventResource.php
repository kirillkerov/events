<?php

namespace App\Http\Resources\Event;

use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user = new UserResource($this->user);
        $user::withoutWrapping();

        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'user' => $user,
            'created' => $this->created_at->diffForHumans(),
        ];
    }
}

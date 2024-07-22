<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
//        return [
//            'id' => $this->id,
//            'name' => $this->name,
//            'email' => $this->email,
//            'entity' => SectionResource::make($this->whenLoaded('section')),
//            'created_at' => $this->created_at->toDateString(),
//        ];
    }
}

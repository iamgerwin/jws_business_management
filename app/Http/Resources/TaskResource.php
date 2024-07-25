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
        $taskable = $this->taskable()->first();
        $owner_type = $this->taskable_type == 'App\Models\Person' ? 'person' : 'business';
        $owner_name =  ($owner_type == 'person') ? $taskable->fullname : $taskable->name;

        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'owner_type' => $owner_type,
            'owner_name' => $owner_name,
            'created_at' => $this->created_at->toFormattedDateString(),
        ];
    }
}

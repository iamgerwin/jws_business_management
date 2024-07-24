<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PersonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'fullname' => $this->fullName,
            'pro_fullname' => $this->professionalFullName,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'id' => $this->id,
            'phone' => $this->phone,
            'business_id' => $this->business_id,
            'business_name' => $this->business?->name ?? '-',
            'tag' => $this->tags,
        ];
    }
}

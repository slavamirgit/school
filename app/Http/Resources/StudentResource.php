<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'grade' => $this->grade->name,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'sex' => $this->sex,
            'age' => $this->age
        ];
    }
}

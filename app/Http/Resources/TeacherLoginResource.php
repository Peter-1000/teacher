<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeacherLoginResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'success' => true,
            'message' => 'Login successful',
            'token' => $this->resource['token'],
            'teacher' => new TeacherResource($this->resource['teacher']),
        ];
    }

    public function withResponse(Request $request, $response): void
    {
        $response->setData($this->toArray($request));
    }
}

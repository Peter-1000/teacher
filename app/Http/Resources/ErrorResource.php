<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ErrorResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'success' => false,
            'message' => $this->resource['exception']->getMessage(),
            'status_code' => is_int($this->resource['exception']->getCode()) ? $this->resource['exception']->getCode() : 500
        ];
    }
}

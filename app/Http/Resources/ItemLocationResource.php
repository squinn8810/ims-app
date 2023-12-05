<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemLocationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
          return [
            'Item' => $this->getItem(),
            'CurrentQty' => $this->itemQty,
            'ReorderQty' => $this->itemReorderQty,
            'Location' => $this->getLocationName(),
            'Message' => $this->getMessage(),
        ];
    }
}

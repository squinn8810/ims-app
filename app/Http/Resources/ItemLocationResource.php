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
            'item' => new ItemResource($this->getItem()),
            'itemQty' => $this->itemQty,
            'reorderQty' => $this->itemReorderQty,
            'location' => $this->getLocationName(),
            'message' => $this->getMessage(),
        ];
    }
}

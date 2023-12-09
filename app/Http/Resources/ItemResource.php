<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'itemName' => $this->itemName,
            'itemUrl' => $this->itemURL,
            'vendor' => new VendorResource($this->getVendor()),
        ];
    }
}

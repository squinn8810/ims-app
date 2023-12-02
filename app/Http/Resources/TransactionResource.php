<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'name' => $this->getUserName(),
            'item' => $this->getItemName(),
            'location' => $this->getLocationName(),
            //'message' =>$this->getMessage(),
        ];
    }
}

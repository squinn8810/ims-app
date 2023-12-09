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
            'Id' => $this->transNum,
            'Date' => $this->getDateAttribute($this->transDate),
            'Item' => $this->getItemName(),
            'Location' => $this->getLocationName(),
            'Status' => $this->status,
            'Employee' => $this->getUserName(),
            'Message' => $this->getMessage(),
        ];
    }
}

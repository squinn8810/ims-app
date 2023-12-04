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
            /*
            'transDate' => $this->transDate,
            'itemLocID' => $this->itemLocID,
            'employeeID' => $this->employeeID,
            'transNum' => $this->transNum,
            'status' => $this->status,
            'message' => $this->getMessage(),
*/



            'name' => $this->getUserName(),
            'item' => $this->getItemName(),
            'location' => $this->getLocationName(),
            'message' => $this->getMessage(),
        ];
    }
}

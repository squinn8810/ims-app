<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VendorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            "vendorName" => $this->vendorName,
            "vendorEmail" => $this->vendorEmail,
            "vendorPhone" => $this->vendorPhone,
            "vendorURL" => $this->vendorURL,
        ];
    }
}
